@if($cars->hasPages())

<div class="d-flex align-items-center justify-content-center py-2">
    <nav aria-label="Pagination">
        <ul class="pagination mb-0">

            <li class="page-item"><a class="page-link" href="{{$cars->previousPageUrl()}}" aria-label="Previous"><i class="fi-chevron-left"></i></a></li>
            @foreach($elements as $element)

                @if(is_array($element))

                    @foreach($element as $page=>$url)
                        @if($page == $cars->currentPage())
                        <li class="page-item"><a class="page-link" href="#">{{$page}}<span class="visually-hidden">(current)</span></a></li>
                        @else
                        <li class="page-item"><a class="page-link" href="#">{{$page}}</a></li>
                        @endif
                    @endforeach

                        <li class="page-item active" aria-current="page"><span class="page-link">3<span class="visually-hidden">(current)</span></span></li>

                    @if($cars->hasMorePages())
                    <li class="page-item"><a class="page-link" href="{{$cars->nextPageUrl()}}" aria-label="Next"><i class="fi-chevron-right"></i></a></li>
                
                    @endif
                @endif
               
            @endforeach

        </ul>
    </nav>
</div>

@endif