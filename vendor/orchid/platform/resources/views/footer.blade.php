@guest
    <p>Crafted with Laravel Orchid by João Cardoso for LiveWall Group</p>
@else

    <div class="text-center user-select-none">
        <p class="small m-0">
            {{ __('The application code is published under the MIT license.') }} 2016 - {{date('Y')}}<br>
            <a href="http://orchid.software" target="_blank" rel="noopener">
                {{ __('Version') }}: {{\Orchid\Platform\Dashboard::VERSION}}
            </a>
        </p>
    </div>
@endguest
