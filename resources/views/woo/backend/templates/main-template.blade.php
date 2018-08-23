@extends(config('settings.backEndTheme').'.layouts.main-layout')
@section('section_title')
    {!! $section_title !!}
@endsection
@section('content')
    {!! $content !!}
@endsection
