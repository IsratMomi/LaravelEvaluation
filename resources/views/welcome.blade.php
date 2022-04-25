@extends('layouts.app')

@section('content')
 <section pt-5>
     <div class="container">
         <div class="row">
             <div class="col-md-12">
                <form action="{{route('search')}}" method="post">
                    @csrf
                    <div class="form-group">
                        <select name="category" id="category" class="form-control input-lg dynamic" data-dependent="category">
                            <option value="">Select Category</option>
                            @foreach ($products as $product )
                                <option value="{{$product->category_id}}">{{$product->category->title}}</option>
                            @endforeach

                        </select>
                        <br/>
                        <select name="sub_category" id="subcategory" class="form-control input-lg dynamic" data-dependent="category">
                            <option value="">Select SubCategory</option>
                            @foreach ($subcategories as $subcategory )
                                <option value="{{$subcategory->id}}">{{$subcategory->title}}</option>
                            @endforeach
                        </select>
                        <br/>
                        <select name="price" id="price" class="form-control input-lg dynamic" data-dependent="category">
                            <option value="">Select Price</option>
                            @foreach ($products as $product )
                                <option value="{{$product->price}}">{{$product->price}}</option>
                            @endforeach
                        </select>
                        <br/>
                        <input type="submit" class="btn btn-success" value="Search"/>
                    </div>
                </form>
             </div>
         </div>
     </div>
 </section>
 <section class="pt-5">
     <div class="container">
        <div class="row">
            @isset($datas)
            @foreach ($datas as $data)
            <div class="col-md-4">
                <h1>{{$data->title}}</h1>
                <h3>{{$data->category_id}}</h3>
                <h4>{{$data->price}}</h4>
                <p>{{$data->thumbnail}}</p>
            </div>
            @endforeach


            @endisset()

        </div>
     </div>
 </section>

@endsection
