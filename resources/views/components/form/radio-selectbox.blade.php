@props([
    'disabled' => false,
    'checked' => false,
])

<input
    {{ $disabled ? 'disabled' : ''}}
    {{ $checked ? 'checked' : ''}}
    {!! $attributes->merge([
            'class' => 'w-4 h-4 text-green-600 bg-gray-100 border-gray-300 focus:ring-green-500 dark:focus:ring-green-600 dark:ring-offset-gray-800 dark:bg-gray-600 dark:border-gray-400',
        ])
    !!}
>
 