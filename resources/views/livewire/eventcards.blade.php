<div class="row mt-2">
    @forelse($events as $dt)
    <div class="col-lg-4 mb-2">
        <div class="card h-100">
            <div class="card-header">
                <div class="d-flex justify-content-between">
                    <h5 class="card-title text-truncate" style="max-width: 100%; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">{{ $dt->title ?? '' }} </h5>
                    <div class="d-flex">
                        <button class="btn btn-success btn-icon mr-1" @click="$dispatch('edit', { id : {{ $dt->id}} } )">
                            <i class="typcn typcn-pencil"></i>
                        </button>
                        <button class="btn btn-secondary btn-icon mr-1" @click="$dispatch('view_attendees', { id : {{ $dt->id}} } )">
                            <i class="typcn typcn-th-list"></i>
                        </button>
                        @if($dt->status == 'ONGOING')
                        <a class="btn btn-info btn-icon mr-1" href="{{ route('time_sheet', encrypt($dt->id) ) }}">
                            <i class="typcn typcn-document-text"></i>
                        </a>
                        @endif
                    </div>
                </div>
            </div>
            <div class="card-body">
                <p class="m-0">Event Code:</p>
                <h4 class="m-0 text-dark">{{ $dt->code ?? '' }}</h4>
                <hr>
                <p class="text-truncate mt-4" style="max-width: 100%; white-space: nowrap; overflow: hidden; text-overflow: ellipsis;">About: {{ $dt->particulars ?? '' }} </p>
                <div class="d-flex">
                    <div class="media mx-1">
                        <div class="media-body">
                            <label class="text-secondary">Target date(start)</label>
                            <h6>{{ \Carbon\Carbon::parse($dt->reg_start_date)->format('F j, Y') }}</h6>
                        </div>
                    </div>

                    <div class="media mx-1">
                        <div class="media-body">
                            <label class="text-secondary">Time</label>
                            <h6>{{ \Carbon\Carbon::parse($dt->reg_start_time)->format('h:i A') }} to {{ \Carbon\Carbon::parse($dt->reg_end_time)->format('h:i A') }} </h6>
                        </div>
                    </div>
                </div>
                @if($dt->status == 'PENDING')
                <span class="badge badge-info">PENDING</span>
                @elseif($dt->status == 'ONGOING')
                <span class="badge badge-success">ONGOING</span>
                @else
                <span class="badge badge-danger">FINISHED</span>
                @endif
            </div>
        </div>
    </div>
    @empty
    <div class="col-lg-12 text-center">
        <h4 class="mt-5">No Data</h4>
    </div>
    @endforelse
</div>