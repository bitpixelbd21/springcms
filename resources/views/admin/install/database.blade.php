@extends('river::admin.install.layout')

@section('content')
<form method="POST" action="{{ route('install.saveDatabase') }}">
  <div class="container container-tight py-4" style="max-width: 30rem;">
    {{-- <div class="text-center mb-4">
          <a href="." class="navbar-brand navbar-brand-autodark">
            <svg xmlns="http://www.w3.org/2000/svg" width="110" height="32" viewBox="0 0 232 68" class="navbar-brand-image">
              <path d="M64.6 16.2C63 9.9 58.1 5 51.8 3.4 40 1.5 28 1.5 16.2 3.4 9.9 5 5 9.9 3.4 16.2 1.5 28 1.5 40 3.4 51.8 5 58.1 9.9 63 16.2 64.6c11.8 1.9 23.8 1.9 35.6 0C58.1 63 63 58.1 64.6 51.8c1.9-11.8 1.9-23.8 0-35.6zM33.3 36.3c-2.8 4.4-6.6 8.2-11.1 11-1.5.9-3.3.9-4.8.1s-2.4-2.3-2.5-4c0-1.7.9-3.3 2.4-4.1 2.3-1.4 4.4-3.2 6.1-5.3-1.8-2.1-3.8-3.8-6.1-5.3-2.3-1.3-3-4.2-1.7-6.4s4.3-2.9 6.5-1.6c4.5 2.8 8.2 6.5 11.1 10.9 1 1.4 1 3.3.1 4.7zM49.2 46H37.8c-2.1 0-3.8-1-3.8-3s1.7-3 3.8-3h11.4c2.1 0 3.8 1 3.8 3s-1.7 3-3.8 3z" fill="#066fd1" style="fill: var(--tblr-primary, #066fd1)"></path>
              <path d="M105.8 46.1c.4 0 .9.2 1.2.6s.6 1 .6 1.7c0 .9-.5 1.6-1.4 2.2s-2 .9-3.2.9c-2 0-3.7-.4-5-1.3s-2-2.6-2-5.4V31.6h-2.2c-.8 0-1.4-.3-1.9-.8s-.9-1.1-.9-1.9c0-.7.3-1.4.8-1.8s1.2-.7 1.9-.7h2.2v-3.1c0-.8.3-1.5.8-2.1s1.3-.8 2.1-.8 1.5.3 2 .8.8 1.3.8 2.1v3.1h3.4c.8 0 1.4.3 1.9.8s.8 1.2.8 1.9-.3 1.4-.8 1.8-1.2.7-1.9.7h-3.4v13c0 .7.2 1.2.5 1.5s.8.5 1.4.5c.3 0 .6-.1 1.1-.2.5-.2.8-.3 1.2-.3zm28-20.7c.8 0 1.5.3 2.1.8.5.5.8 1.2.8 2.1v20.3c0 .8-.3 1.5-.8 2.1-.5.6-1.2.8-2.1.8s-1.5-.3-2-.8-.8-1.2-.8-2.1c-.8.9-1.9 1.7-3.2 2.4-1.3.7-2.8 1-4.3 1-2.2 0-4.2-.6-6-1.7-1.8-1.1-3.2-2.7-4.2-4.7s-1.6-4.3-1.6-6.9c0-2.6.5-4.9 1.5-6.9s2.4-3.6 4.2-4.8c1.8-1.1 3.7-1.7 5.9-1.7 1.5 0 3 .3 4.3.8 1.3.6 2.5 1.3 3.4 2.1 0-.8.3-1.5.8-2.1.5-.5 1.2-.7 2-.7zm-9.7 21.3c2.1 0 3.8-.8 5.1-2.3s2-3.4 2-5.7-.7-4.2-2-5.8c-1.3-1.5-3-2.3-5.1-2.3-2 0-3.7.8-5 2.3-1.3 1.5-2 3.5-2 5.8s.6 4.2 1.9 5.7 3 2.3 5.1 2.3zm32.1-21.3c2.2 0 4.2.6 6 1.7 1.8 1.1 3.2 2.7 4.2 4.7s1.6 4.3 1.6 6.9-.5 4.9-1.5 6.9-2.4 3.6-4.2 4.8c-1.8 1.1-3.7 1.7-5.9 1.7-1.5 0-3-.3-4.3-.9s-2.5-1.4-3.4-2.3v.3c0 .8-.3 1.5-.8 2.1-.5.6-1.2.8-2.1.8s-1.5-.3-2.1-.8c-.5-.5-.8-1.2-.8-2.1V18.9c0-.8.3-1.5.8-2.1.5-.6 1.2-.8 2.1-.8s1.5.3 2.1.8c.5.6.8 1.3.8 2.1v10c.8-1 1.8-1.8 3.2-2.5 1.3-.7 2.8-1 4.3-1zm-.7 21.3c2 0 3.7-.8 5-2.3s2-3.5 2-5.8-.6-4.2-1.9-5.7-3-2.3-5.1-2.3-3.8.8-5.1 2.3-2 3.4-2 5.7.7 4.2 2 5.8c1.3 1.6 3 2.3 5.1 2.3zm23.6 1.9c0 .8-.3 1.5-.8 2.1s-1.3.8-2.1.8-1.5-.3-2-.8-.8-1.3-.8-2.1V18.9c0-.8.3-1.5.8-2.1s1.3-.8 2.1-.8 1.5.3 2 .8.8 1.3.8 2.1v29.7zm29.3-10.5c0 .8-.3 1.4-.9 1.9-.6.5-1.2.7-2 .7h-15.8c.4 1.9 1.3 3.4 2.6 4.4 1.4 1.1 2.9 1.6 4.7 1.6 1.3 0 2.3-.1 3.1-.4.7-.2 1.3-.5 1.8-.8.4-.3.7-.5.9-.6.6-.3 1.1-.4 1.6-.4.7 0 1.2.2 1.7.7s.7 1 .7 1.7c0 .9-.4 1.6-1.3 2.4-.9.7-2.1 1.4-3.6 1.9s-3 .8-4.6.8c-2.7 0-5-.6-7-1.7s-3.5-2.7-4.6-4.6-1.6-4.2-1.6-6.6c0-2.8.6-5.2 1.7-7.2s2.7-3.7 4.6-4.8 3.9-1.7 6-1.7 4.1.6 6 1.7 3.4 2.7 4.5 4.7c.9 1.9 1.5 4.1 1.5 6.3zm-12.2-7.5c-3.7 0-5.9 1.7-6.6 5.2h12.6v-.3c-.1-1.3-.8-2.5-2-3.5s-2.5-1.4-4-1.4zm30.3-5.2c1 0 1.8.3 2.4.8.7.5 1 1.2 1 1.9 0 1-.3 1.7-.8 2.2-.5.5-1.1.8-1.8.7-.5 0-1-.1-1.6-.3-.2-.1-.4-.1-.6-.2-.4-.1-.7-.1-1.1-.1-.8 0-1.6.3-2.4.8s-1.4 1.3-1.9 2.3-.7 2.3-.7 3.7v11.4c0 .8-.3 1.5-.8 2.1-.5.6-1.2.8-2.1.8s-1.5-.3-2.1-.8c-.5-.6-.8-1.3-.8-2.1V28.8c0-.8.3-1.5.8-2.1.5-.6 1.2-.8 2.1-.8s1.5.3 2.1.8c.5.6.8 1.3.8 2.1v.6c.7-1.3 1.8-2.3 3.2-3 1.3-.7 2.8-1 4.3-1z" fill-rule="evenodd" clip-rule="evenodd" fill="#4a4a4a"></path>
            </svg>
          </a>
        </div> --}}
    <div class="card card-md">
      <div class="card-body text-center py-4 p-sm-5">

        <h1 class="mt-5">SpringCMS Installer</h1>
        <p class="text-secondary"></p>
      </div>
      <div class="card-body">
        <div class="container">
          <h1>Database Configuration</h1>

          @csrf
    

          <div class="mb-3 row">
            <label for="db_host" class="col-4 col-form-label required">DB Host</label>
            <div class="col">
              <input type="text"
                id="db_host"
                name="db_host"
                value="{{ old('db_host', session('db_host', '127.0.0.1')) }}"
                required
                placeholder="127.0.0.1" class="form-control" aria-describedby="emailHelp" />
            </div>
          </div>


          <div class="mb-3 row">
            <label for="db_port" class="col-4 col-form-label required">DB Port</label>
            <div class="col">
              <input type="text"
                id="db_port"
                name="db_port"
                value="{{ old('db_port', session('db_port', '3306')) }}"
                required
                placeholder="3306" class="form-control" aria-describedby="emailHelp" />
            </div>
          </div>


          <div class="mb-3 row">
            <label for="db_database" class="col-4 col-form-label required">DB Name</label>
            <div class="col">
              <input type="text"
                class="form-control"
                id="db_database"
                name="db_database"
                value="{{ old('db_database', session('db_database')) }}"
                required
                placeholder="Database Name" class="form-control" />
            </div>
          </div>



          <div class="mb-3 row">
            <label for="db_username" class="col-4 col-form-label required">DB Username</label>
            <div class="col">
              <input type="text"
                id="db_username"
                name="db_username"
                value="{{ old('db_username', session('db_username')) }}"
                required
                placeholder="Username" class="form-control" />
            </div>
          </div>


          <div class="mb-3 row">
            <label for="db_password" class="col-4 col-form-label required">DB Password</label>
            <div class="col">
              <input type="password"
                class="form-control"
                id="db_password"
                name="db_password"
                value="{{ old('db_password', session('db_password')) }}"
                placeholder="Password" />
            </div>
          </div>



          {{-- <div class="form-check mb-3">
            <input
              class="form-check-input"
              type="checkbox"
              id="create_database"
              name="create_database"
              {{ session('create_database') ? 'checked' : '' }}
          >
          <label class="form-check-label" for="create_database">
            Create Database if not exists
          </label>
        </div> --}}


        {{-- <button type="submit">Save</button> --}}
        <button id="test-connection" class="btn btn-primary" type="button">Test Connection</button>
        <div id="connection-status"></div>
      </div>


    </div>
  </div>
  <div class="row align-items-center mt-3">
    <div class="col-4">
      <div class="progress">
        <div class="progress-bar" style="width: 50%" role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100" aria-label="25% Complete">
          <span class="visually-hidden">50% Complete</span>
        </div>
      </div>
    </div>
    <div class="col">
      <div class="btn-list justify-content-end">
        <a href="{{ route('install.index') }}" class="btn btn-link link-secondary">
          Go back
        </a>
        <button type="submit" class="btn btn-primary">
          Next
          </a>
      </div>
    </div>
  </div>
  </div>
</form>

@endsection

@push('scripts')
<script>
  document.getElementById('test-connection').addEventListener('click', function() {
    event.preventDefault();

    // Get form data
    const dbHost = document.querySelector('#db_host').value;
    const dbPort = document.querySelector('#db_port').value;
    const dbDatabase = document.querySelector('#db_database').value;
    const dbUsername = document.querySelector('#db_username').value;
    const dbPassword = document.querySelector('#db_password').value;
    //const createDatabase = document.querySelector('#create_database').checked;

    // Prepare data object
    const data = {
      db_host: dbHost,
      db_port: dbPort,
      db_database: dbDatabase,
      db_username: dbUsername,
      db_password: dbPassword,
      //create_database: createDatabase,
    };
    fetch("/install/test-db", {
        method: 'POST',
        headers: {
          'X-CSRF-TOKEN': "{{ csrf_token() }}",
          'Content-Type': 'application/json',
        },
        body: JSON.stringify(data),
      })
      .then(response => response.json())
      .then(data => {
        let html = '';
        if (data.success) {
          html = `<div class="alert alert-success alert-dismissible" role="alert">
                      <div class="d-flex">
                        <div>
                          <!-- Download SVG icon from http://tabler-icons.io/i/check -->
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon alert-icon"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M5 12l5 5l10 -10"></path></svg>
                        </div>
                        <div>
                          Database connection successful
                        </div>
                      </div>
                      <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                    </div>`;
        } else {
          html = `<div class="alert alert-danger alert-dismissible" role="alert">
                      <div class="d-flex">
                        <div>
                          <!-- Download SVG icon from http://tabler-icons.io/i/alert-circle -->
                          <svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="icon alert-icon"><path stroke="none" d="M0 0h24v24H0z" fill="none"></path><path d="M3 12a9 9 0 1 0 18 0a9 9 0 0 0 -18 0"></path><path d="M12 8v4"></path><path d="M12 16h.01"></path></svg>
                        </div>
                        <div>
                          ${data.message}
                        </div>
                      </div>
                      <a class="btn-close" data-bs-dismiss="alert" aria-label="close"></a>
                    </div>`
        }
        document.getElementById('connection-status').innerHTML = html;
      });
  });
</script>
@endpush