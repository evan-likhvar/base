@extends(config('settings.frontEndTheme').'.layouts.main-layout')

@section('navbar')
    @if(!empty($navbar))
        {!! $navbar !!}
    @endif
@endsection

@section('content')
    @if(!empty($content))
        {!! $content !!}
    @endif
@endsection

@section('footer')
    @if(!empty($footer))
        {!! $footer !!}
    @endif
@endsection