{{-- Allow only landlords to accss these.. --}}
@can('add-landlord-residence')<li><a href="{{ route('landlord.add')}}">Add Residence</a></li>@endcan