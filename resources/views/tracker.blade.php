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
                    <span class="tracker-info-value">12 Hour 13 mins</span>
                </li>
                <li>
                    <span class="tracker-info-label">Activity Started:</span>
                    <span class="tracker-info-value">18 June 2016 at 00:00:00</span>
                </li>
                <li>
                    <span class="tracker-info-label">Activity Finished:</span>
                    <span class="tracker-info-value">-</span>
                </li>
            </ul>
        </div>
        <hr/>
    </div>
    <div class="tracker-body">
        <button class="btn btn-primary">Add Action +</button>
        <div class="tracker-action-item">
            <div class="tracker-action-main">
                <div class="row">
                    <div class="col-xs-12 col-md-9">
                        Configure css and javascript
                    </div>
                    <div class="col-xs-12 col-md-3">
                        Start / Stop / Done
                    </div>
                </div>
            </div>
            <div class="tracker-action-history hidden">
                <div class="action-history-item">
                    <div class="action-history-info">
                        <span>Started at:</span><span>13 June 2016 00:00:00</span>
                        <span>Finished at:</span><span>13 June 2016 00:00:00</span>
                    </div>
                    <div class="action-history-description">
                        Comment: hjdsdsd
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection