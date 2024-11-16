<div class="container mt-4">
    <div class="row mb-3">
        <div class="col-md-8">
            <h3>{{ __('attributes.reviews') }}</h3>
        </div>
        <div class="col-md-4 text-end">
            <a href="{{ route('review.create', $viewData['instrument']->getId())}}" class="btn btn-primary">{{ __('messages.add_review') }}</a>
        </div>
    </div>
    @if (isset($viewData['reviews']) && count($viewData['reviews']) > 0)
    <ul class="list-group">
        @foreach ($viewData['reviews'] as $review)
        <li class="list-group-item">
            <strong>{{ $review->user->getName() }}</strong>
            <p>Score: {{ $review->getScore() }} / 5</p>
            <p>{{ $review->getDescription()}}</p>
        </li>
        @endforeach
    </ul>
    @else
    <p>{{ __('attributes.no_reviews') }}</p>
    @endif
</div>