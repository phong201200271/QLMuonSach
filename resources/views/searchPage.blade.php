{{--@include('layout.header')--}}
{{--<x-sidebar/>--}}
@extends('layout.layout')

@section('title')
    {{$wordSearch}} - Tìm kiếm
@endsection

@section('content')
<style>
    .pagination {
        display: flex;
        margin-top: 20px;
    }

    .pagination ul {
        list-style-type: none;
        padding: 0;
        margin: 0;
    }

    .pagination li {
        display: inline-block;
        margin-right: 5px;
    }

    .pagination li a {
        display: block;
        padding: 8px 12px;
        text-decoration: none;
        background-color: #f2f2f2;
        color: #333;
    }

    .pagination li a:hover {
        background-color: #ddd;
    }

    .pagination li a.active {
        background-color: #4CAF50;
        color: white;
    }
</style>
<div class="col-10" style="margin: auto; padding-top: 50px">
    <div class="card card-primary">
        <div class="card-body">
            <div>
                <div style="position: relative; padding-bottom: 30px">
                    <label style="font-size: 30px">Trang tìm kiếm</label>
                </div>
                @if($books->isEmpty())
                    <h2 style="display: flex; justify-content: center;align-items: center">Không có kết quả tìm kiếm phù hợp</h2>
                @else
                    <div class="filter-container p-0 row">
                        @foreach($books as $book)
                            <div class="filtr-item col-sm-3" style="border: 1px solid rgb(233, 233, 233); text-align: center;">
                                <div style="padding: 30px">
                                    <div class="book_image" style="width: 200px;height: 300px;margin: auto;display: flex;justify-content: center;align-items: center">
                                        <img src="{{asset('storage/'.$book->thumbnail)}}" style="max-width: 100%;max-height:100%;object-fit: cover">
                                    </div>
                                    <div class="book_info" style="height: 80px; margin-top: 20px">
                                        <h6 style="font-weight: bold" class="book_name"><a>{{$book->name}}</a></h6>
                                        <div class="rent_price" style="font-size: 16px;color: #fe4c50;font-weight: 600">{{number_format($book->price_rent, 0, ',', '.')}}VNĐ /1 tháng</div>
                                    </div>
                                    <a style="color: black" type="button" class="btn btn-block btn-primary" href="{{route('detail_book',['id'=>$book->id])}}">Chi tiết</a>
                                </div>
                            </div>
                        @endforeach
                    </div>
                @endif

            </div>
        </div>
    </div>
</div>
@if($books->isEmpty())

@else
    <div class="pagination" style="align-items: center; justify-content: center">
        <ul id="ulPagination">
            @for($i = 1; $i <= $books->lastPage(); $i++)
                <li>
                    <a href="{{ route('allBook', ['page' => $i]) }}">{{ $i }}</a>
                </li>
            @endfor
        </ul>
    </div>
@endif

{{--@include('layout.footer')--}}
@endsection
