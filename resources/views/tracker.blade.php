@extends('layout.base')

@section('pageTitle', $pageTitle)

@section('container')
<div id="tracker-content">
    <div class="tracker-head">
        <h1 class="title">{{ $tracker->name }}</h1>
        <div class="tracker-info">
            <ul class="tracker-info-list">
                <li>
                    <span class="tracker-info-label">Owner:</span>
                    <span class="tracker-info-value">
                        @if ($tracker->user)
                            {{ $tracker->user->name }}
                        @else
                            None (everyone can edit)
                        @endif
                    </span>
                </li>
                <li>
                    <span class="tracker-info-label">Created:</span>
                    <span class="tracker-info-value">{{ $tracker->created_at->diffForHumans() }}</span>
                </li>
                <li>
                    <span class="tracker-info-label">Current Status:</span>
                    <span class="tracker-info-value">{{ $trackerStatus }}</span>
                </li>
                <li>
                    <span class="tracker-info-label">Running Time:</span>
                    <span class="tracker-info-value">{{ $trackerTotalRunning }}</span>
                </li>
                <li>
                    <span class="tracker-info-label">Activity Started:</span>
                    <span class="tracker-info-value">{{ $trackerHistoryStarted or ' - ' }}</span>
                </li>
                <li>
                    <span class="tracker-info-label">Activity Finished:</span>
                    <span class="tracker-info-value">{{ $trackerHistoryFinished or ' - ' }}</span>
                </li>
            </ul>
        </div>
        <hr/>
    </div>
    <div class="tracker-body">
        
        @include('components.tracker-create')
        
        <div class="row">
            <div class="col-xs-12 col-md-9">
                @include('components.tracker-list')
            </div>
            <div class="col-xs-12 col-md-3">
                Another infoss
            </div>
        </div>
        
    </div>
</div>
@endsection

@section('script_init')
<script type="text/javascript">
    var trackerId = '{{ $tracker->slug }}',
        trackerOwner = {{ $tracker->owner_id }},
        currentUser = {{ Auth::check() ? Auth::user()->id : 'null' }};
</script>
@endsection