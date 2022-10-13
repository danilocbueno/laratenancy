@props(['amount' => 0])

<div>
    R$ {{number_format((float) ($amount), 2, ',', '.')}}
</div>
