@extends(config('settings.backEndTheme').'.layouts.main-layout')
@section('section_title')
    @if(!empty($section_title))
        {!! $section_title !!}
    @endif
@endsection
@section('content')
    @if(!empty($content))
        {!! $content !!}
    @endif
@endsection
