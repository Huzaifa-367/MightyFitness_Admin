@if( count($data) > 0 )
    @foreach ($data as $assigndiet)
        <tr>
            <td><img src="{{ getSingleMedia($assigndiet, 'diet_image') }}" alt="diet-image"class="bg-soft-primary rounded img-fluid avatar-40 me-3"></td>
            <td>{{ $assigndiet->title }}</td>
            <td>
            <a class="btn btn-sm btn-icon btn-danger" 
                    data-bs-toggle="tooltip" href="{{ route('delete.assigndiet', [ 'diet_id' => $assigndiet->id, 'user_id' => $user_id ]) }}"
                    data--confirmation='true'
                    data--ajax='true'
                    data-title="{{ __('message.delete_form_title',[ 'form'=> __('message.assigndiet') ]) }}"
                    title="{{ __('message.delete_form_title',[ 'form'=>  __('message.assigndiet') ]) }}"
                    data-message='{{ __("message.delete_msg") }}'>
                    <span class="btn-inner">
                        <svg width="20" viewBox="0 0 24 24" fill="none"
                            xmlns="http://www.w3.org/2000/svg" stroke="currentColor"> <path d="M19.3248 9.46826C19.3248 9.46826 18.7818 16.2033 18.4668 19.0403C18.3168 20.3953 17.4798 21.1893 16.1088 21.2143C13.4998 21.2613 10.8878 21.2643 8.27979 21.2093C6.96079 21.1823 6.13779 20.3783 5.99079 19.0473C5.67379 16.1853 5.13379 9.46826 5.13379 9.46826"
                                stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path d="M20.708 6.23975H3.75" stroke="currentColor" stroke-width="1.5" stroke-linecap="round" stroke-linejoin="round"></path>
                            <path
                                d="M17.4406 6.23973C16.6556 6.23973 15.9796 5.68473 15.8256 4.91573L15.5826 3.69973C15.4326 3.13873 14.9246 2.75073 14.3456 2.75073H10.1126C9.53358 2.75073 9.02558 3.13873 8.87558 3.69973L8.63258 4.91573C8.47858 5.68473 7.80258 6.23973 7.01758 6.23973"
                                stroke="currentColor" stroke-width="1.5"
                                stroke-linecap="round" stroke-linejoin="round"></path>
                        </svg>
                    </span>
                </a>
            </td>
        </tr>
    @endforeach
@else
    <tr>
        <td colspan="3">
            {{ __('message.not_found_entry', [ 'name' => __('message.diet') ]) }}
        </td>
    </tr>
@endif