<x-app-layout>
    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">

                    <div class="row">
                        <div class="col-3 p-5">
                            <img src="{{url('/storage/')}}/{{$user->profile->profileImage()}}" style="height: 150px; width: 150px" class="rounded-circle center-block"/>
                        </div>
                        <div class="col-9 p-5">
                            <div class="d-flex justify-content-between align-items-baseline">
                                <div class="d-flex pb-3">
                                    <div class="d-flex justify-content-between align-items-baseline pr-3 h3">
                                        {{ $user->username }}
                                        @can('update', $user->profile)
                                            <a href="{{url('/profile/')}}/{{ $user->id }}/edit">
                                                <svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-pencil" viewBox="0 0 16 16">
                                                    <path d="M12.146.146a.5.5 0 0 1 .708 0l3 3a.5.5 0 0 1 0 .708l-10 10a.5.5 0 0 1-.168.11l-5 2a.5.5 0 0 1-.65-.65l2-5a.5.5 0 0 1 .11-.168l10-10zM11.207 2.5 13.5 4.793 14.793 3.5 12.5 1.207 11.207 2.5zm1.586 3L10.5 3.207 4 9.707V10h.5a.5.5 0 0 1 .5.5v.5h.5a.5.5 0 0 1 .5.5v.5h.293l6.5-6.5zm-9.761 5.175-.106.106-1.528 3.821 3.821-1.528.106-.106A.5.5 0 0 1 5 12.5V12h-.5a.5.5 0 0 1-.5-.5V11h-.5a.5.5 0 0 1-.468-.325z"/>
                                                </svg>
                                            </a>
                                        @endcan
                                        </div>
                                     <div id="app">
                                        <follow :user-id="'{{ $user->id }}'" :follows="'{{ $follows }}'"></follow>
                                    </div>

                                </div>

                                @can('update', $user->profile)
                                    <a href="{{url('/p/create')}}">Create</a>
                                @endcan
                            </div>
                            <div class="d-flex">
                                <div class="pr-5"><strong>{{ $postCount }}</strong> posts</div>
                                <div class="pr-5"><strong>{{ $followesCount }}</strong> followers</div>
                                <div class="pr-5"><strong>{{ $followingCount }}</strong> followings</div>
                            </div>
                            <div class="pt-4 font-weight-bold">{{ $user->profile->title ??'' }}</div>
                            <div>{{ $user->profile->description ?? '' }}</div>
                            <div><a href="#" class="font-weight-bold">{{ $user->profile->url ?? '' }}</a></div>
                        </div>
                    </div>
                    <div class="row">
                        @foreach ( $user->posts as $post )
                            <div class="col-4 pb-4">
                                <a href="{{url('/p/')}}/{{$post->id}}">
                                    <img src="{{url('/storage/')}}/{{$post->image}}" class="h-100">
                                </a>
                            </div>
                        @endforeach
                    </div>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
