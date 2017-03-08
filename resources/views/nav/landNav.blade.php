{{-- Allow only landlords to accss these.. --}}
@can('add-landlord-residence')<li><a href="{{ route('residence.add')}}">Add Residence</a></li>@endcan