@extends('ray::'. $template .'.layouts.app')

@push("title") Страница авторизации @endpush

@section("content")
    <div >
        <div class="container d-flex" style="height: 500px">
            <div class="row align-items-center justify-content-center">
                <div class="col-4">
                    Одна из трёх колонок
                </div>
                <div class="col-4">
                    Одна из трёх колонок
                </div>
                <div class="col-4">
                    Одна из трёх колонок
                </div>
            </div>
        </div>
    </div>
@endsection

@push('footer')
    <script></script>
@endpush
