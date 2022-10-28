<nav class="navbar navbar-dark sticky-top bg-dark flex-md-nowrap p-0">
    <a class="navbar-brand col-sm-3 col-md-2 mr-0" href="#">Company name</a>
    <input class="form-control form-control-dark w-100" type="text" placeholder="Search" aria-label="Pesquisar">
    <ul class="navbar-nav px-3">
      <li class="nav-item text-nowrap">
        <a class="nav-link" href="  {{route('logout')}} ">Sair</a>
      </li>
    </ul>
  </nav>

  <div class="container-fluid">
    <div class="row">
      <nav class="col-md-2 d-none d-md-block bg-light sidebar">
        <div class="sidebar-sticky">
          <ul class="nav flex-column">
            <li class="nav-item">
                <a class="nav-link active" href="  {{route('index.produtos')}} ">
                  <span data-feather="shopping-cart"></span>
                  Produtos <span class="badge badge-info">
                    {{\Cart::session(Auth::user()->id)->getContent()->count() ?? 0}}
                  </span>
                </a>
              </li>

            <li class="nav-item">
              <a class="nav-link" href="#">
                <span data-feather="file"></span>
                Vendas
              </a>
            </li>

            <li class="nav-item">
              <a class="nav-link" href="  {{route('index.clientes')}} ">
                <span data-feather="users"></span>
                Clientes
              </a>
            </li>

            <li class="nav-item">
                <a class="nav-link" href="  {{route('index.usuario')}} ">
                  <span data-feather="users"></span>
                  Usuarios
                </a>
              </li>
            <li class="nav-item">
              <a class="nav-link" href="#">
                <span data-feather="bar-chart-2"></span>
                Relatorios
              </a>
            </li>

          </ul>
          </ul>
        </div>
      </nav>
