<x-app-layout>
    <div class="center">
        <div class="menu">
            <div class="container">
            </div>
            @if(!empty($graphics))
                <div class="container-fluid p-0">
                    <div class="single-item">
                        @foreach($graphics as $graphic)
                            <div class="single-item-duration" data-time="{{ $graphic->duration * 1000 }}">
                                <div class="banner-part"><img
                                        src="{{ asset(str_replace('public/','storage/',$graphic->image)) }}"
                                        class="img-fluid" alt="">
                                    <div class="banner-details">
                                        <h1 class="mb-3">{{ $graphic->content ?? '' }}</h1>
                                    </div>
                                </div>
                            </div>
                        @endforeach
                    </div>
                </div>
            @endif

            </div>
            <div class="container bg-light border  mb-5 p-4">
                <div class="row justify-content-center align-items-center mb-2">
                    <div class="col-md-5 col-lg-3 pb-md-0 pb-3">
                        <div class="d-flex justify-content-center align-items-end">
                            <div>
                                <label for="search_query" class="form-label mb-0">Searching with postal code
                                    : </label>
                                <input type="text" class="form-control"
                                       id="search_query" name="postal_code_search"
                                       value="">
                                <div class="text-danger">@error('postal_code') {{ $message }} @enderror</div>
                            </div>
                            <div class="ps-2">
                                <button class="btn btn-primary" id="post_code_search">Search</button>
                            </div>
                        </div>
                    </div>
                    <input type="hidden"
                           name="admin_lat"
                           id="admin_lat">

                    <input type="hidden"
                           name="admin_lng"
                           id="admin_lng"
                        >
                </div>
                <div class="row">
                    <div>
                        <div id="postal_code_map" class="w-75 mx-auto" style="height: 750px;"></div>
                    </div>
                </div>
            </div>
            <div class="container-fluid bg-primary-light">

                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
