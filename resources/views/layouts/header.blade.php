<nav class="navbar navbar-expand-lg navbar-dark bg-dark mb-5">
    <div class="container-fluid">
        <a class="navbar-brand mb-0 h1" href="#">{{ env('APP_NAME', 'Farmasi Veteran') }}</a>
        <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbar-menu" aria-controls="menu" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbar-menu">
            <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbar-menu-user-management" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Maintenances
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbar-menu-user-management">
                        <li><a class="dropdown-item" href="{{ route('agencies.index') }}">Agencies</a></li>
                        <li><a class="dropdown-item" href="{{ route('armyTypes.index') }}">Army Types</a></li>
                        <li><a class="dropdown-item" href="{{ route('clinics.index') }}">Clinics</a></li>
                        <li><a class="dropdown-item" href="{{ route('frequencies.index') }}">Frequencies</a></li>
                        <li><a class="dropdown-item" href="{{ route('genders.index') }}">Genders</a></li>
                        <li><a class="dropdown-item" href="{{ route('hospitals.index') }}">Hospitals</a></li>
                        <li><a class="dropdown-item" href="{{ route('instructions.index') }}">Instructions</a></li>
                        <li><a class="dropdown-item" href="{{ route('orderStatuses.index') }}">Order Statuses</a></li>
                        <li><a class="dropdown-item" href="{{ route('patientRelations.index') }}">Patient Relations</a></li>
                        <li><a class="dropdown-item" href="{{ route('quantityFormulas.index') }}">Quantity Formulas</a></li>
                        <li><a class="dropdown-item" href="{{ route('salesPersons.index') }}">Sales Persons</a></li>
                        <li><a class="dropdown-item" href="{{ route('states.index') }}">States</a></li>
                        <li><a class="dropdown-item" href="{{ route('uOMs.index') }}">UOMs</a></li>
                        <li><a class="dropdown-item" href="{{ route('veteranStatuses.index') }}">Veteran Statuses</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbar-menu-user-management" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        Patients
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbar-menu-user-management">
                        <li><a class="dropdown-item" href="{{ route('armyCards.index') }}">Army Cards</a></li>
                        <li><a class="dropdown-item" href="{{ route('patients.index') }}">Patients</a></li>
                    </ul>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbar-menu-user-management" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                        User Managements
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbar-menu-user-management">
                        <li><a class="dropdown-item" href="{{ route('roles.index') }}">Roles</a></li>
                        <li><a class="dropdown-item" href="{{ route('users.index') }}">Users</a></li>
                    </ul>
                </li>
            </ul>
            {{-- <ul class="navbar-nav ms-auto mb-2 mb-lg-0">
                <li class="nav-item">
                    <a class="nav-link" href="#">Link</a>
                </li>
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                    Dropdown
                    </a>
                    <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                        <li><a class="dropdown-item" href="#">Action</a></li>
                        <li><a class="dropdown-item" href="#">Another action</a></li>
                        <li><hr class="dropdown-divider"></li>
                        <li><a class="dropdown-item" href="#">Something else here</a></li>
                    </ul>
                </li>
            </ul> --}}
        </div>
    </div>
</nav>