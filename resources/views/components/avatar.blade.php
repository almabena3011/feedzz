@php
 if($object->avatar)
    $avatar_url = asset("images/avatar/". $object->avatar);
 else 
     $avatar_url = "https://ui-avatars.com/api/?name=" . $object->username;
@endphp

{{-- Component gambar --}}
<img class="rounded-circle mb-2" src="{{ $avatar_url }}" alt="Foto {{ $object->username }}" width="{{ $size ?? 128 }}" height="{{ $size ?? 128 }}"/>