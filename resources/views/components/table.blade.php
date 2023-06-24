<table {{ $attributes->merge(['class' => 'table table-striped mt-3'])}}>
    @isset($thead)
        <thead>
            {{ $thead }}
        </thead>
    @endisset

    <tbody>
        {{ $slot }}
    </tbody>

    @isset($tfoot)
        {{ $tfoot }}
    @endisset
</table>