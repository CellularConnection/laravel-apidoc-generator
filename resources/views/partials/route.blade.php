<!-- START_{{$route['id']}} -->
## {{$route['uri']}}
@if($route['authenticated'])

    <br><small style="padding: 1px 9px 2px;font-weight: bold;white-space: nowrap;color: #ffffff;-webkit-border-radius: 9px;-moz-border-radius: 9px;border-radius: 9px;background-color: #3a87ad;">Requires authentication</small>@endif
@if($route['description'])
    {!! $route['description'] !!}
@endif

> Example request:

```bash
curl -X {{$route['methods'][0]}} {{$route['methods'][0] == 'GET' ? '-G ' : ''}}"{{ trim(config('app.docs_url') ?: config('app.url'), '/')}}/{{ ltrim($route['uri'], '/') }}" @if(count($route['headers']))\
@foreach($route['headers'] as $header => $value)
    -H "{{$header}}: {{$value}}"@if(! ($loop->last) || ($loop->last && count($route['bodyParameters']))) \
    @endif
@endforeach
@endif
@if(count($route['cleanBodyParameters']) || (array_key_exists('Content-Type', $route['headers']) && $route['headers']['Content-Type'] === 'application/json'))
    -d '{!! json_encode($route['cleanBodyParameters'] ? : $route['bodyParameters']) !!}'
@endif
```

### HTTP Request
@foreach($route['methods'] as $method)
    `{{$method}} {{$route['uri']}}`
@endforeach
@if(count($route['bodyParameters']))
    #### Body Parameters

    Parameter | Type | Status | Description
    --------- | ------- | ------- | ------- | -----------
    @foreach($route['bodyParameters'] as $attribute => $parameter)
        {{$attribute}} | {{$parameter['type']}} | @if($parameter['required']) required @else optional @endif | {!! $parameter['description'] !!}
    @endforeach
@endif
@if(count($route['queryParameters']))
    #### Query Parameters

    Parameter | Status | Description
    --------- | ------- | ------- | -----------
    @foreach($route['queryParameters'] as $attribute => $parameter)
        {{$attribute}} | @if($parameter['required']) required @else optional @endif | {!! $parameter['description'] !!}
    @endforeach
@endif

<!-- END_{{$route['id']}} -->
