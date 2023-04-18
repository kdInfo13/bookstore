@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">{{ __('Book List') }}</div>
                <div class="card-body">
                    @if($book)
                        <strong>Book title:</strong>  {{$book->title}}<br><br>
                        <strong>Book Description:</strong>  {{$book->description}}<br><br>
                        <strong>Category:</strong>  {{$book->categorie->name}}<br><br>
                        @if($book->authors)
                        <strong>Author:</strong>
                            @foreach($book->authors as $author)
                                <span class="badge text-dark">{{$author->name}}</span>
                            @endforeach
                        @endif
                        <br><br>
                        <h4>Total Rating count:  {{$book->getTotalReview()}}</h4>
                        <h4>Average Rating:  {{$book->getRoundedRating()}}/5</h4>
                        @guest
                        <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                        @else
                        <a href="javascript:void(0);" data-bs-toggle="modal" data-bs-target="#exampleModal">Write Review</a>
                        @endguest
                        <hr>
                        @if(count($book->reviews) > 0)
                          <ul>
                            @foreach($book->reviews as $review)
                            <li>
                             <p> <strong>User name:</strong> {{$review->user->name}}</p>
                             <p> <strong>Rating:</strong> {{$review->rating}}</p>
                             <p> <strong>Review:</strong> {{$review->review}}</p>
                             <p> <strong>Posted At:</strong> {{$review->created_at}}</p>
                            </li>
                            <hr>
                            @endforeach
                          </ul>
                        @else
                        <h3>No review posted yet.</h3>
                        @endif
                    @else
                    <h3>No data found</h3>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h1 class="modal-title fs-5" id="exampleModalLabel">Add Review</h1>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <div class="modal-body">
        <form class="rating">
            <input type="hidden" name="book_id" value="{{$book->id}}">
            <div class="form-group">
            <div class="rate">
            <input type="radio" id="star5" name="rating" value="5" />
            <label for="star5" title="text">5 stars</label>
            <input type="radio" id="star4" name="rating" value="4" />
            <label for="star4" title="text">4 stars</label>
            <input type="radio" id="star3" name="rating" value="3" />
            <label for="star3" title="text">3 stars</label>
            <input type="radio" id="star2" name="rating" value="2" />
            <label for="star2" title="text">2 stars</label>
            <input type="radio" id="star1" name="rating" value="1" />
            <label for="star1" title="text">1 star</label>
          </div>  
            </div>

            <div class="form-group">
              <textarea name="review" class="form-control" rows="4" cols="50"></textarea>
            </div>

        </form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
        <button type="button" id="submit-review" class="btn btn-primary">Save changes</button>
      </div>
    </div>
  </div>
</div>
@endsection
<style>
 .rate {
    float: left;
    height: 46px;
    padding: 0 10px;
}
.rate:not(:checked) > input {
    position:absolute;
    top:-9999px;
}
.rate:not(:checked) > label {
    float:right;
    width:1em;
    overflow:hidden;
    white-space:nowrap;
    cursor:pointer;
    font-size:30px;
    color:#ccc;
}
.rate:not(:checked) > label:before {
    content: '★ ';
}
.rate > input:checked ~ label {
    color: #ffc700;    
}
.rate:not(:checked) > label:hover,
.rate:not(:checked) > label:hover ~ label {
    color: #deb217;  
}
.rate > input:checked + label:hover,
.rate > input:checked + label:hover ~ label,
.rate > input:checked ~ label:hover,
.rate > input:checked ~ label:hover ~ label,
.rate > label:hover ~ input:checked ~ label {
    color: #c59b08;
}
</style>
@section('scripts')
  <script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
  <script>
$(document).ready(function() {
  $("#submit-review").on('click', function(e){
  $.ajaxSetup({
          headers: {
              'X-CSRF-TOKEN': jQuery('meta[name="csrf-token"]').attr('content')
          }
      });
      e.preventDefault();
   var rate =  $("input[name='rating']:checked").val();
    if(rate){
     $.ajax({
            type: 'POST',
            url: '{{route("add-review")}}',
            data: $(".rating").serializeArray(),
            dataType: 'json',
            success: function (data) {
              if(data.status){
                location.reload();
              }else{
                alert(data.message)
                location.reload();
              }
            },
            error: function (error) {
              if(error.status){
                alert(error.responseJSON.message)
              }
            }
        });
    }else{
      alert('Rating is required.')
    }
  })  
})
</script>
@endsection
