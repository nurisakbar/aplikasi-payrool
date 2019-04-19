{{-- <div class="callout callout-info">
    <h4>Tip!</h4>

    <p>Add the layout-top-nav class to the body tag to get this layout. This feature can also be used with a
      sidebar! So use this class if you want to remove the custom dropdown menus from the navbar and use regular
      links instead.</p>
  </div>
  <div class="callout callout-danger">
    <h4>Warning!</h4>

    <p>The construction of this layout differs from the normal one. In other words, the HTML markup of the navbar
      and the content will slightly differ than that of the normal layout.</p>
  </div> --}}

  @if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif