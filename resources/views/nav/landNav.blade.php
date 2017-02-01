{{-- Allow only landlords to accss these.. --}}
@can('add-landlord-residence')<li><a href="{{ url('landlord/add_residence')}}">Add Residence</a></li>@endcan