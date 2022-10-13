@setup
	require __DIR__.'/vendor/autoload.php';
	$dotenv = Dotenv\Dotenv::createImmutable(__DIR__);
	try {
		$dotenv->load();
		$dotenv->required(['DEPLOY_SERVER', 'DEPLOY_REPOSITORY', 'DEPLOY_PATH'])->notEmpty();
	} catch ( Exception $e )  {
		echo $e->getMessage();
		exit;
	}

	$server = $_ENV['DEPLOY_SERVER'] ?? null;
	$repo = $_ENV['DEPLOY_REPOSITORY'] ?? null;
	$path = $_ENV['DEPLOY_PATH'] ?? null;
	$slack = $_ENV['DEPLOY_SLACK_WEBHOOK'] ?? null;
	$healthUrl = $_ENV['DEPLOY_HEALTH_CHECK'] ?? null;

	if ( substr($path, 0, 1) !== '/' ) throw new Exception('Careful - your deployment path does not begin with /');

	$date = ( new DateTime )->format('YmdHis');
	$env = isset($env) ? $env : "main";
	$branch = isset($branch) ? $branch : "main";
	$path = rtrim($path, '/');
	$release = $path.'/releases/'.$date;
	
	try {
		$url = "http://10.112.70.1";


		$username = readline("Informe seu prontuario:");
		

		system('stty -echo');
		$password = readline("Informe sua senha: ");
		system('stty echo');


$str = <<<EOF

------------------
DEPLOY DA APLICAÇÃO
------------------
Usuário responsável: $username 
Caminho para upload dos arquivos no servidor: $path

Repositório do projeto: $repo
Branch para deploy: $branch 

Digite y para confirmar: 
EOF;		

		$resposta = readline($str);

		if($resposta != "y") {
			exit('deploy cancelado');
		}

		
	} catch ( Exception $e )  {
		echo $e->getMessage();
		exit;
	}

@endsetup

@servers(['web' => $server])

@task('init')

	{{-- deployment_proxy_login --}}
	echo "Liberando o acesso a internet para: {{ $username }}";
	if [[ $(curl -s http://10.112.70.1) =~ .*"IP address already in use"|"Login succeeded".* ]]; then
		printf "Acesso a internet garantido. para {{ $username }} e {{ $password }} \n"
	else
		if [[ $(curl -s -X POST -F "login={{ $username }}" -F "password={{ $password }}" http://10.112.70.1) =~ .*"IP address already in use"|"Login succeeded".* ]]; then
			printf "Acesso a internet garantido.\n"
		else
			printf "Usuário ou senha inválidos.\n"
		fi
	fi

	if [ ! -d {{ $path }}/storage ]; then
		cd {{ $path }}
		git clone {{ $repo }} --branch={{ $branch }} --depth=1 -q {{ $release }}
		echo "Repository cloned"
		mv {{ $release }}/storage {{ $path }}/storage
		ln -s {{ $path }}/storage {{ $release }}/storage
		echo "Storage directory set up"
		cp {{ $release }}/.env.example {{ $path }}/.env
		ln -s {{ $path }}/.env {{ $release }}/.env
		echo "Environment file set up"
		rm -rf {{ $release }}
		echo "Deployment path initialised. Edit {{ $path }}/.env then run 'envoy run deploy'."
	else
		echo "Deployment path already initialised (storage directory exists)!"
	fi
@endtask

@story('deploy')
	deploy-all
@endstory

@task('deploy-all')

	{{-- deployment_proxy_login --}}
	echo "Liberando o acesso a internet para: {{ $username }}";
	if [[ $(curl -s http://10.112.70.1) =~ .*"IP address already in use"|"Login succeeded".* ]]; then
		printf "Acesso a internet garantido.\n"
	else
		if [[ $(curl -s -X POST -F "login={{ $username }}" -F "password={{ $password }}" http://10.112.70.1) =~ .*"IP address already in use"|"Login succeeded".* ]]; then
			printf "Acesso a internet garantido.\n"
		else
			printf "Usuário ou senha inválidos.\n"
		fi
	fi

	{{--deployment_start--}}
	echo "Deployment start...";
	cd {{ $path }}
	echo "Deployment ({{ $date }}) started"
	git clone {{ $repo }} --branch={{ $branch }} --depth=1 -q {{ $release }}
	echo "Repository cloned"


	{{-- deployment_links --}}
	echo "deployment_links...";
	cd {{ $path }}
	rm -rf {{ $release }}/storage
	ln -s {{ $path }}/storage {{ $release }}/storage
	echo "Storage directories set up"
	ln -s {{ $path }}/.env {{ $release }}/.env
	echo "Environment file set up"

	{{-- deployment_composer --}}
	echo "deployment_composer...";
	echo "Installing composer dependencies..."
	cd {{ $release }}
	composer install --no-interaction --quiet --no-dev --prefer-dist --optimize-autoloader --ignore-platform-reqs

	{{-- deployment_migrate --}}
	echo "deployment_migrate..."
	php {{ $release }}/artisan migrate --env={{ $env }} --force --no-interaction

	{{-- deployment_cache --}}
	echo "deployment_cache..."
	php {{ $release }}/artisan view:clear --quiet
	php {{ $release }}/artisan cache:clear --quiet
	php {{ $release }}/artisan config:cache --quiet
	echo "Cache cleared"

	{{-- deployment_finish --}}
	echo "deployment_finish...";
	php {{ $release }}/artisan storage:link
	echo "Storage symbolic links created"
	php {{ $release }}/artisan queue:restart --quiet
	echo "Queue restarted"
	ln -nfs {{ $release }} {{ $path }}/current
	echo "Deployment ({{ $date }}) finished"

	{{-- health_check --}}

	{{-- deployment_option_cleanup --}}
	echo "deployment_option_cleanup..";
	cd {{ $path }}/releases
	@if ( isset($cleanup) && $cleanup )
		find . -maxdepth 1 -name "20*" | sort | head -n -4 | xargs rm -Rf
		echo "Cleaned up old deployments"
	@endif
@endtask

@story('rollback')
	deployment_rollback
	health_check
@endstory

@task('deployment_proxy_login')
	echo "Liberando o acesso a internet para: {{ $username }}";
	if [[ $(curl -s http://10.112.70.1) =~ .*"IP address already in use"|"Login succeeded".* ]]; then
		printf "logado\n"
	else
		if [[ $(curl -s -X POST -F "login={{ $username }}" -F "password={{ $password }}" http://10.112.70.1) =~ .*"IP address already in use"|"Login succeeded".* ]]; then
			printf "logado\n"
		else
			printf "problemas na autenticação"
		fi

	fi
@endtask

@task('deployment_start')
	cd {{ $path }}
	echo "Deployment ({{ $date }}) started"
	git clone {{ $repo }} --branch={{ $branch }} --depth=1 -q {{ $release }}
	echo "Repository cloned"
@endtask

@task('deployment_links')
	cd {{ $path }}
	rm -rf {{ $release }}/storage
	ln -s {{ $path }}/storage {{ $release }}/storage
	echo "Storage directories set up"
	ln -s {{ $path }}/.env {{ $release }}/.env
	echo "Environment file set up"
@endtask

@task('deployment_composer')
	echo "Installing composer dependencies..."
	cd {{ $release }}
	composer install --no-interaction --quiet --no-dev --prefer-dist --optimize-autoloader --ignore-platform-reqs
@endtask

@task('deployment_migrate')
	php {{ $release }}/artisan migrate --env={{ $env }} --force --no-interaction
@endtask

@task('deployment_npm')
	echo "Installing npm dependencies..."
	cd {{ $release }}
	npm install --no-audit --no-fund --no-optional
	echo "Running npm..."
	npm run {{ $env }} --silent
@endtask

@task('deployment_cache')
	php {{ $release }}/artisan view:clear --quiet
	php {{ $release }}/artisan cache:clear --quiet
	php {{ $release }}/artisan config:cache --quiet
	echo "Cache cleared"
@endtask

@task('deployment_finish')
	php {{ $release }}/artisan storage:link
	echo "Storage symbolic links created"
	php {{ $release }}/artisan queue:restart --quiet
	echo "Queue restarted"
	ln -nfs {{ $release }} {{ $path }}/current
	echo "Deployment ({{ $date }}) finished"
@endtask

@task('deployment_cleanup')
	cd {{ $path }}/releases
	find . -maxdepth 1 -name "20*" | sort | head -n -4 | xargs rm -Rf
	echo "Cleaned up old deployments"
@endtask

@task('deployment_option_cleanup')
	cd {{ $path }}/releases
	@if ( isset($cleanup) && $cleanup )
		find . -maxdepth 1 -name "20*" | sort | head -n -4 | xargs rm -Rf
		echo "Cleaned up old deployments"
	@endif
@endtask


@task('health_check')
	@if ( ! empty($healthUrl) )
		if [ "$(curl --write-out "%{http_code}\n" --silent --output /dev/null {{ $healthUrl }})" == "200" ]; then
			printf "\033[0;32mHealth check to {{ $healthUrl }} OK\033[0m\n"
		else
			printf "\033[1;31mHealth check to {{ $healthUrl }} FAILED\033[0m\n"
		fi
	@else
		echo "No health check set"
	@endif
@endtask


@task('deployment_rollback')
	cd {{ $path }}/releases
	ln -nfs {{ $path }}/releases/$(find . -maxdepth 1 -name "20*" | sort  | tail -n 2 | head -n1) {{ $path }}/current
	echo "Rolled back to $(find . -maxdepth 1 -name "20*" | sort  | tail -n 2 | head -n1)"
@endtask

{{--
@finished
	@slack($slack, '#deployments', "Deployment on {$server}: {$date} complete")
@endfinished
--}}


