<?
date_default_timezone_set("Chile/Continental");
//echo 'date_default_timezone_set: ' . date_default_timezone_get() . '<br />';


$nav='<nav>
<ul class="nav">
<li><a class="a_menu" href="consulta_producto.php">Productos</a></li>
<li><a class="a_menu" href="#">Facturación &nbsp;&#721;</a>

<ul>
<li><a class="a_menu" href="factura_venta.php">Factura Venta</a></li>
<li><a class="a_menu" href="consulta_nota.php">Nota Crédito</a></li>
<li><a class="a_menu" href="guia_despacho.php">Guía Despacho</a></li>
</ul>
</li>

<li><a class="a_menu" href="factura_compra.php">Compras</a></li>
<li><a class="a_menu" href="consulta_cliente.php">Clientes</a></li>
<li><a class="a_menu" href="consulta_proveedor.php">Proveedores</a> </li>
<li><a class="a_menu" href="consulta_vendedor.php">Vendedores</a></li>

<li><a class="a_menu" href="#">Pagos &nbsp;&#721;</a>
<ul>
<li><a class="a_menu" href="consulta_pago_ventas.php">Pagos Ventas</a></li>
<li><a class="a_menu" href="consulta_pago_compras.php">Pagos Compras</a></li>
</ul></li>

<li><a class="a_menu" href="#">Máquinas &nbsp;&#721;</a>
<ul class="sub">
<li><a class="a_menu" href="orden_trabajo.php">Orden Trabajo</a></li>
<li><a class="a_menu" href="consulta_maquinas_reparacion.php">Máquinas en Reparación</a></li>
<li><a class="a_menu" href="consulta_maquinas_venta.php">Máquinas en Stock</a></li>
</ul></li>

</ul>
</nav>';

$logo='<svg id="logo_svg" xmlns="http://www.w3.org/2000/svg" xmlns:xlink="http://www.w3.org/1999/xlink" version="1.1" id="Capa_1" x="0px" y="0px" width="312.655px" height="134.505px" viewBox="2 1 312.655 134.505" enable-background="new 2 1 312.655 134.505" xml:space="preserve" xmlns:xml="http://www.w3.org/XML/1998/namespace">
<path fill="#F70B28" d="M303.203,17.585c6.471,0.774,11.766,11.677,11.438,17.372c-1.36,1.395-2.733-0.703-5.719,0  c-0.336,3.751,3.088,3.862,3.271,7.108c-1.371,1.303-3.671,1.713-4.9,3.159c1.086,1.578,3.627,1.761,5.719,2.368  c-4.299,7.171-8.383,14.539-15.521,18.952c4.119-6.389-1.045-15.883-4.9-22.9c-1.314-0.221-1.404,0.75-2.451,0.79  c0.303,2.605,1.912,3.949,3.271,5.527c-0.653,1.737-1.646,3.149-4.087,3.159c0,1.84,0,3.688,0,5.528  c-2.775,2.841-7.927,3.396-8.171,8.687c-4.053-0.467-10.229,1.133-8.17,3.949c-1.137,1.801-5.688,0.293-8.17,0.793  c3.398-4.354,6.291-9.188,9.807-13.429c0.384-1.682-1.169-1.5-2.45-1.58c1.442-2.55,2.45-5.527,3.271-8.686  c-6.332,2.037-7.715,8.867-13.072,11.844c2.175-4.572,1.15-14.529,5.721-19.742c-6.037-3.979-3.508-13.393-13.072-15.004  c0.359,0.703,0.719,1.414,1.633,1.58c-10.211-1.841-32.336-8.26-40.03,3.159c-7.154-0.071-7.06,6.861-13.89,7.106  c1.056-1.611,3.961-1.437,3.27-4.738c-7.694,0.205-15.344,7.273-19.605,13.425c-6.268,0-12.523,0-18.791,0  c1.686-4.17,6.455-5.346,5.721-11.846c5.236,0.056,2.853-7.249,7.354-7.896c1.576,1.073-1.145,4.635-1.635,6.317  c8.062-1.429,9.552-16.038,22.059-15.793c2.116-2.961,5.598-4.595,9.805-5.527c-6.633-4.478,22.021-5.599,27.779-1.58  c1.109-0.245,0.678-1.973,0.814-3.159c-3.03-0.75-4.885-2.645-8.986-2.368c2.354-3.87,10.997-2.306,14.706-0.79  c2.483,0.032,3.179-1.666,4.901-2.369c15.629-0.103,23.938,6.87,39.215,7.107c5.934,3.475,9.271,9.468,14.707,13.424  C305.759,21.27,303.889,18.091,303.203,17.585z"/>
<path fill="#F70B28" d="M149.876,95.892c-2.794,5.728-7.173,9.916-11.438,14.213c-0.596-2.416,1.414-2.319,0.817-4.733  c-5.122,7.682-12.198,13.479-18.791,19.737c-9.714,0.449-17.165,7.707-26.144,9.478c-12.639,2.49-30.384-0.979-45.752,0  c-1.577-5.582-5.719-8.688-11.438-10.269c-0.425,1.757,3.031,6.522,7.353,6.317c-2.182,2.062-7.206,0.164-9.804,0  c-6.846-8.916-17.223-14.409-21.242-26.059c-0.049,2.439,0.613,10.977,4.085,12.635c-3.04,0.023-6.356-6.479-10.621-7.896  C6.788,103.526,6.183,93.797,2,89.573c2.018-3.975,2.557-7.48,4.085-10.266C7.221,78.54,5.186,90.108,8.536,91.94  c1.994-6.23,2.312-14.08,6.536-18.16c3.056-0.854,2.329,1.961,4.902,1.582c2.002-1.516,4.003-3.498,2.452-6.321  c2.867-0.916,4.411-3.112,8.169-3.159c-0.841,3.184,1.274,3.506,2.451,4.738c-2.827,4.9-4.583,10.83-8.987,14.213  c5.237,1.912,5.996,11.521,13.889,6.318c0.425-3.838-3.472-3.482-3.268-7.107c1.912-0.26,3.374-0.942,4.902-1.584  c-0.637-2.797-0.106-2.856-0.817-6.315c1.144-1.521,3.023-2.33,4.902-3.151c0.017-1.869-1.405-2.322-0.817-4.739  c2.533-2.819,8.538-2.273,8.987-7.107c2.818,4.584-2.01,8.568-3.269,11.846c1.806,5.161,6.054,19.426-0.817,20.528  c0.531,8.437,2.647,15.347,11.438,15.793c0.139-2.763-2.876-2.485-4.085-3.944c3.775-2-1.422-4.232-0.817-7.896  c3.996,2.719,6.127,7.24,10.621,9.479c-0.065-1.248,0.392-3.008-0.817-3.158c5.024-0.893,8.48,6.529,13.072,8.687  c9.109-0.584,14.412,2.994,22.059,0c-1.871-0.828-2.892-2.463-5.719-2.369c6.944-0.924,11.773-3.885,19.608-3.944  c3.488-4.5,9.102-3.01,13.889-4.738C133.389,99.104,139.091,92.874,149.876,95.892z"/>
<g>
	<rect x="61.032" y="50.9" fill="none" width="202.612" height="26.06"/>
	<path fill="#333333" stroke="#000000" stroke-width="0.5" stroke-miterlimit="10" d="M69.007,67.437   c-0.079,1.095,0.05,1.912,0.386,2.453c0.626,0.985,1.958,1.479,3.996,1.479c1.22,0,2.239-0.131,3.056-0.391   c1.556-0.498,2.479-1.424,2.771-2.779c0.179-0.791-0.045-1.403-0.671-1.837c-0.616-0.422-1.657-0.796-3.123-1.121l-2.502-0.569   c-2.451-0.563-4.097-1.176-4.937-1.837c-1.421-1.105-1.875-2.833-1.36-5.185c0.47-2.145,1.668-3.927,3.593-5.347   c1.925-1.419,4.449-2.129,7.572-2.129c2.608,0,4.685,0.669,6.229,2.007c1.544,1.338,2.082,3.28,1.612,5.827h-4.97   c0.235-1.441-0.185-2.465-1.26-3.072c-0.716-0.401-1.673-0.602-2.871-0.602c-1.332,0-2.454,0.26-3.366,0.78   c-0.913,0.52-1.469,1.246-1.671,2.178c-0.19,0.856,0.062,1.495,0.756,1.918c0.437,0.282,1.438,0.612,3.005,0.991l4.046,0.991   c1.769,0.434,3.05,1.014,3.845,1.739c1.231,1.127,1.612,2.758,1.142,4.892c-0.481,2.188-1.746,4.006-3.794,5.452   c-2.049,1.447-4.651,2.172-7.808,2.172c-3.224,0-5.603-0.713-7.136-2.139c-1.533-1.428-2.026-3.385-1.478-5.875L69.007,67.437   L69.007,67.437z"/>
	<path fill="#333333" stroke="#000000" stroke-width="0.5" stroke-miterlimit="10" d="M106.098,72.702   c-2.272,1.863-5.177,2.795-8.714,2.795c-3.537,0-6.039-0.932-7.505-2.795c-2.004-2.286-2.53-5.58-1.578-9.882   c0.962-4.388,2.938-7.682,5.927-9.882c2.272-1.863,5.177-2.795,8.714-2.795s6.039,0.932,7.505,2.795   c2.015,2.2,2.541,5.494,1.579,9.882C111.073,67.122,109.098,70.416,106.098,72.702z M106.854,62.82   c0.582-2.687,0.434-4.765-0.445-6.233c-0.879-1.468-2.342-2.202-4.391-2.202s-3.842,0.731-5.381,2.194   c-1.539,1.463-2.605,3.543-3.199,6.241c-0.594,2.698-0.442,4.779,0.454,6.242c0.896,1.461,2.367,2.192,4.416,2.192   c2.048,0,3.836-0.729,5.364-2.192C105.199,67.599,106.26,65.518,106.854,62.82z"/>
	<path fill="#333333" stroke="#000000" stroke-width="0.5" stroke-miterlimit="10" d="M118.59,50.875h5.171l-4.315,19.649h12.257   l-0.94,4.307h-17.429L118.59,50.875z"/>
	<path fill="#333333" stroke="#000000" stroke-width="0.5" stroke-miterlimit="10" d="M141.442,53.377   c2.452-1.972,5.233-2.958,8.345-2.958c4.164,0,6.917,1.322,8.261,3.966c0.738,1.484,0.979,2.974,0.722,4.469h-5.17   c-0.078-1.148-0.319-2.015-0.722-2.6c-0.706-1.041-1.981-1.561-3.829-1.561c-1.88,0-3.526,0.734-4.936,2.202   c-1.411,1.469-2.407,3.546-2.989,6.233c-0.594,2.688-0.465,4.7,0.386,6.038c0.851,1.338,2.16,2.006,3.929,2.006   c1.813,0,3.325-0.573,4.534-1.722c0.66-0.618,1.298-1.544,1.914-2.779h5.121c-1.019,2.611-2.627,4.736-4.826,6.371   c-2.2,1.637-4.738,2.455-7.615,2.455c-3.56,0-6.118-1.104-7.673-3.315c-1.544-2.222-1.892-5.267-1.041-9.135   C136.769,58.866,138.632,55.642,141.442,53.377z"/>
	<path fill="#333333" stroke="#000000" stroke-width="0.5" stroke-miterlimit="10" d="M178.684,72.702   c-2.271,1.863-5.179,2.795-8.716,2.795c-3.536,0-6.038-0.932-7.504-2.795c-2.004-2.286-2.53-5.58-1.577-9.882   c0.961-4.388,2.938-7.682,5.926-9.882c2.272-1.863,5.18-2.795,8.715-2.795c3.537,0,6.039,0.932,7.508,2.795   c2.014,2.2,2.541,5.494,1.576,9.882C183.66,67.122,181.684,70.416,178.684,72.702z M179.439,62.82   c0.582-2.687,0.434-4.765-0.445-6.233c-0.879-1.468-2.342-2.202-4.391-2.202s-3.845,0.731-5.381,2.194   c-1.539,1.463-2.605,3.543-3.199,6.241c-0.594,2.698-0.441,4.779,0.453,6.242c0.896,1.461,2.364,2.192,4.416,2.192   c2.049,0,3.836-0.729,5.362-2.192C177.785,67.599,178.846,65.518,179.439,62.82z"/>
	<path fill="#333333" stroke="#000000" stroke-width="0.5" stroke-miterlimit="10" d="M209.158,50.875l-0.939,4.242h-7.404   L196.5,74.831h-5.205l4.314-19.713h-7.438l0.938-4.242H209.158z"/>
	<path fill="#333333" stroke="#000000" stroke-width="0.5" stroke-miterlimit="10" d="M229.542,55.117h-13.099l-1.106,5.087h12.021   l-0.924,4.161h-12.021l-1.345,6.159h13.701l-0.938,4.309h-18.756l5.256-23.958h18.149L229.542,55.117z"/>
	<path fill="#333333" stroke="#000000" stroke-width="0.5" stroke-miterlimit="10" d="M236.962,53.377   c2.451-1.972,5.233-2.958,8.347-2.958c4.164,0,6.918,1.322,8.26,3.966c0.74,1.484,0.979,2.974,0.727,4.469h-5.172   c-0.078-1.148-0.316-2.015-0.725-2.6c-0.705-1.041-1.979-1.561-3.828-1.561c-1.881,0-3.523,0.734-4.938,2.202   c-1.408,1.469-2.404,3.546-2.986,6.233c-0.596,2.688-0.465,4.7,0.388,6.038c0.852,1.338,2.159,2.006,3.93,2.006   c1.812,0,3.324-0.573,4.533-1.722c0.66-0.618,1.299-1.544,1.914-2.779h5.118c-1.02,2.611-2.627,4.736-4.825,6.371   c-2.199,1.637-4.736,2.455-7.613,2.455c-3.562,0-6.116-1.104-7.674-3.315c-1.545-2.222-1.894-5.267-1.041-9.135   C232.289,58.866,234.152,55.642,236.962,53.377z"/>
	<path fill="#333333" stroke="#000000" stroke-width="0.5" stroke-miterlimit="10" d="M259.453,73.708   c-0.964,0.75-2.004,1.123-3.123,1.123c-1.156,0-2.047-0.383-2.672-1.149s-0.812-1.709-0.568-2.828   c0.258-1.162,0.896-2.127,1.918-2.896c0.965-0.721,1.986-1.08,3.068-1.08c1.133,0,2.016,0.389,2.646,1.166   c0.629,0.777,0.825,1.715,0.586,2.812C261.061,71.983,260.441,72.935,259.453,73.708z M255.292,68.548   c-0.797,0.646-1.293,1.416-1.489,2.305c-0.199,0.922-0.039,1.705,0.485,2.351c0.521,0.646,1.248,0.967,2.187,0.967   c0.936,0,1.801-0.324,2.604-0.976c0.803-0.647,1.305-1.432,1.506-2.342c0.192-0.886,0.033-1.651-0.479-2.306   c-0.521-0.662-1.246-0.993-2.181-0.993C256.979,67.556,256.104,67.886,255.292,68.548z M254.914,73.065l0.969-4.409   c0.283,0,0.705,0.001,1.268,0.002c0.562,0.002,0.873,0.005,0.938,0.008c0.354,0.024,0.64,0.101,0.849,0.228   c0.358,0.215,0.485,0.566,0.379,1.053c-0.082,0.371-0.248,0.639-0.5,0.803c-0.25,0.166-0.531,0.266-0.851,0.297   c0.271,0.059,0.47,0.145,0.593,0.254c0.219,0.209,0.278,0.539,0.186,0.988l-0.092,0.395c-0.008,0.043-0.014,0.086-0.021,0.129   c-0.006,0.043-0.004,0.086,0.004,0.131l0.011,0.123h-1.138c-0.008-0.141,0.013-0.344,0.062-0.607   c0.051-0.27,0.063-0.445,0.049-0.539c-0.027-0.155-0.115-0.266-0.266-0.324c-0.082-0.034-0.213-0.061-0.392-0.067L256.7,71.51   h-0.253l-0.34,1.562h-1.193V73.065L254.914,73.065z M257.863,69.524c-0.148-0.062-0.371-0.092-0.67-0.092h-0.291l-0.277,1.277   h0.463c0.279,0,0.508-0.055,0.688-0.162c0.181-0.105,0.295-0.279,0.354-0.521C258.177,69.786,258.089,69.618,257.863,69.524z"/>
</g>
<g>
	<rect x="61.114" y="83.069" fill="none" width="193.458" height="11.846"/>
	<path stroke="#000000" stroke-width="0.5" stroke-miterlimit="10" d="M62.25,91.896V83.07h1.514l3.437,7.785h0.029l3.378-7.785h1.5   v8.826h-0.99v-7.869h-0.029l-3.437,7.869H66.72l-3.451-7.869H63.24v7.869H62.25z"/>
	<path stroke="#000000" stroke-width="0.5" stroke-miterlimit="10" d="M73.461,91.896l4.121-8.826h1.121l4.019,8.826h-1.019   l-1.208-2.771h-4.776l-1.238,2.771H73.461z M76.053,88.415h4.106l-2.053-4.633L76.053,88.415z"/>
	<path stroke="#000000" stroke-width="0.5" stroke-miterlimit="10" d="M93.25,91.969l-0.553,0.564l-1.543-1.006   c-0.359,0.188-0.755,0.336-1.187,0.438c-0.432,0.107-0.91,0.16-1.435,0.16c-0.806,0-1.514-0.123-2.126-0.367   c-0.611-0.242-1.121-0.576-1.529-0.996c-0.408-0.424-0.713-0.912-0.917-1.475c-0.204-0.563-0.306-1.158-0.306-1.795   c0-0.613,0.1-1.201,0.299-1.763c0.199-0.562,0.497-1.056,0.896-1.481c0.398-0.429,0.9-0.771,1.507-1.027   c0.606-0.26,1.318-0.389,2.133-0.389c0.737,0,1.41,0.104,2.017,0.309c0.606,0.205,1.126,0.504,1.558,0.896   c0.432,0.392,0.767,0.877,1.004,1.459c0.238,0.58,0.357,1.246,0.357,1.998c0,0.719-0.131,1.385-0.393,1.998   c-0.262,0.611-0.655,1.137-1.18,1.568L93.25,91.969z M91.124,90.584c0.447-0.358,0.777-0.812,0.99-1.354   c0.213-0.545,0.32-1.123,0.32-1.734c0-0.662-0.1-1.238-0.298-1.729c-0.199-0.49-0.473-0.9-0.823-1.232   c-0.35-0.33-0.762-0.578-1.238-0.742c-0.476-0.164-0.995-0.244-1.558-0.244c-0.669,0-1.25,0.109-1.74,0.33   c-0.49,0.222-0.893,0.517-1.208,0.884c-0.315,0.366-0.549,0.788-0.699,1.262c-0.15,0.478-0.226,0.968-0.226,1.476   c0,0.521,0.075,1.021,0.226,1.494c0.151,0.475,0.384,0.891,0.699,1.25c0.315,0.358,0.718,0.646,1.208,0.856   c0.49,0.213,1.08,0.317,1.769,0.317c0.369,0,0.704-0.035,1.005-0.104c0.301-0.065,0.577-0.166,0.83-0.287l-1.194-0.771l0.524-0.573   L91.124,90.584z"/>
	<path stroke="#000000" stroke-width="0.5" stroke-miterlimit="10" d="M95.477,83.069h0.99v5.26c0,1.096,0.243,1.885,0.728,2.365   c0.485,0.48,1.267,0.725,2.344,0.725c0.563,0,1.041-0.062,1.435-0.188c0.393-0.127,0.711-0.317,0.954-0.576   c0.243-0.258,0.417-0.575,0.524-0.963c0.107-0.385,0.16-0.838,0.16-1.358V83.07h0.99v5.507c0,1.149-0.337,2.03-1.012,2.643   c-0.675,0.609-1.692,0.914-3.051,0.914c-1.369,0-2.388-0.312-3.058-0.934s-1.005-1.494-1.005-2.623L95.477,83.069L95.477,83.069z"/>
	<path stroke="#000000" stroke-width="0.5" stroke-miterlimit="10" d="M106.325,91.896V83.07h0.99v8.826H106.325z"/>
	<path stroke="#000000" stroke-width="0.5" stroke-miterlimit="10" d="M111.013,84.198h-0.029v7.699h-0.99v-8.828h1.121l6.057,7.713   h0.029v-7.713h0.99v8.826h-1.15L111.013,84.198z"/>
	<path stroke="#000000" stroke-width="0.5" stroke-miterlimit="10" d="M119.575,91.896l4.121-8.826h1.121l4.019,8.826h-1.019   l-1.208-2.771h-4.776l-1.238,2.771H119.575z M122.167,88.415h4.106l-2.053-4.633L122.167,88.415z"/>
	<path stroke="#000000" stroke-width="0.5" stroke-miterlimit="10" d="M130.655,89.26c0.039,0.394,0.144,0.728,0.313,1   c0.169,0.273,0.388,0.496,0.655,0.668c0.267,0.173,0.575,0.298,0.924,0.373c0.35,0.078,0.723,0.117,1.121,0.117   c0.466,0,0.869-0.049,1.208-0.146c0.34-0.102,0.617-0.23,0.83-0.398s0.372-0.36,0.473-0.582c0.102-0.221,0.153-0.453,0.153-0.699   c0-0.342-0.092-0.62-0.276-0.834c-0.185-0.211-0.425-0.385-0.721-0.521c-0.296-0.135-0.636-0.239-1.02-0.321   c-0.384-0.082-0.776-0.162-1.179-0.238c-0.403-0.076-0.796-0.17-1.18-0.273c-0.383-0.105-0.723-0.25-1.019-0.43   c-0.296-0.182-0.537-0.41-0.721-0.691c-0.185-0.281-0.277-0.641-0.277-1.072c0-0.303,0.075-0.598,0.226-0.883   c0.15-0.287,0.374-0.539,0.67-0.762s0.667-0.396,1.114-0.525c0.447-0.131,0.961-0.197,1.543-0.197c0.592,0,1.109,0.07,1.551,0.209   c0.442,0.14,0.808,0.328,1.1,0.57c0.291,0.24,0.51,0.521,0.655,0.84c0.146,0.316,0.218,0.658,0.218,1.017h-0.946   c0-0.334-0.071-0.625-0.211-0.869c-0.14-0.245-0.333-0.442-0.575-0.603c-0.242-0.155-0.519-0.27-0.83-0.342   c-0.311-0.074-0.631-0.11-0.961-0.11c-0.504,0-0.929,0.06-1.274,0.178c-0.345,0.119-0.619,0.271-0.823,0.459   s-0.345,0.396-0.422,0.625c-0.078,0.229-0.092,0.459-0.043,0.688c0.058,0.285,0.194,0.517,0.408,0.688   c0.213,0.17,0.476,0.312,0.786,0.422c0.31,0.111,0.653,0.201,1.027,0.271s0.754,0.145,1.143,0.222   c0.388,0.076,0.764,0.168,1.128,0.274c0.364,0.105,0.687,0.25,0.968,0.431c0.281,0.179,0.507,0.41,0.677,0.69   c0.17,0.281,0.255,0.636,0.255,1.062c0,0.815-0.335,1.451-1.004,1.899c-0.67,0.447-1.612,0.675-2.825,0.675   c-0.543,0-1.048-0.062-1.514-0.179c-0.466-0.119-0.869-0.299-1.208-0.539c-0.339-0.241-0.604-0.539-0.793-0.896   c-0.189-0.354-0.284-0.773-0.284-1.258L130.655,89.26L130.655,89.26z"/>
	<path stroke="#000000" stroke-width="0.5" stroke-miterlimit="10" d="M149.118,89.616c0.185-0.262,0.304-0.537,0.357-0.826   c0.053-0.291,0.08-0.588,0.08-0.891h0.874c-0.02,0.398-0.08,0.801-0.182,1.193c-0.103,0.396-0.285,0.768-0.547,1.109l1.705,1.688   h-1.18l-1.021-1.043c-0.458,0.459-0.949,0.784-1.474,0.979s-1.138,0.295-1.838,0.295c-0.458,0-0.885-0.062-1.284-0.188   s-0.747-0.306-1.043-0.533c-0.296-0.229-0.53-0.506-0.7-0.825c-0.17-0.322-0.255-0.683-0.255-1.072   c0-0.326,0.067-0.629,0.204-0.904c0.136-0.277,0.318-0.531,0.546-0.764c0.228-0.231,0.493-0.431,0.794-0.604   c0.301-0.176,0.621-0.328,0.961-0.459c-0.282-0.277-0.539-0.578-0.772-0.9c-0.233-0.324-0.349-0.682-0.349-1.072   c0-0.278,0.063-0.524,0.189-0.741c0.126-0.218,0.296-0.396,0.51-0.548c0.213-0.145,0.463-0.256,0.75-0.329   c0.286-0.074,0.589-0.111,0.91-0.111c0.32,0,0.616,0.048,0.888,0.138c0.271,0.09,0.504,0.213,0.699,0.369   c0.194,0.151,0.344,0.336,0.451,0.545c0.107,0.207,0.16,0.426,0.16,0.653c0,0.293-0.056,0.552-0.167,0.769   c-0.112,0.217-0.262,0.408-0.452,0.576c-0.189,0.168-0.41,0.317-0.663,0.459c-0.252,0.139-0.515,0.276-0.786,0.418L149.118,89.616z    M145.638,87.299c-0.291,0.115-0.561,0.252-0.808,0.41c-0.247,0.16-0.461,0.338-0.641,0.533s-0.323,0.406-0.43,0.633   c-0.107,0.226-0.16,0.455-0.16,0.691c0,0.293,0.061,0.559,0.182,0.791c0.122,0.229,0.286,0.432,0.495,0.594   c0.208,0.164,0.456,0.291,0.743,0.381c0.286,0.09,0.599,0.135,0.939,0.135c0.563,0,1.061-0.106,1.493-0.323   c0.432-0.218,0.823-0.502,1.172-0.853L145.638,87.299z M147.502,85.276c0.087-0.164,0.124-0.336,0.109-0.521   c-0.015-0.184-0.078-0.354-0.189-0.502c-0.111-0.149-0.265-0.274-0.458-0.375c-0.194-0.098-0.427-0.146-0.699-0.146   c-0.185,0-0.359,0.024-0.524,0.074c-0.165,0.049-0.313,0.118-0.444,0.209c-0.131,0.09-0.236,0.198-0.313,0.329   c-0.077,0.132-0.116,0.277-0.116,0.441c0,0.131,0.039,0.271,0.116,0.428c0.077,0.156,0.172,0.31,0.284,0.455   c0.111,0.146,0.23,0.287,0.357,0.422c0.126,0.138,0.237,0.252,0.334,0.353c0.292-0.146,0.585-0.312,0.881-0.483   C147.136,85.782,147.356,85.556,147.502,85.276z"/>
	<path stroke="#000000" stroke-width="0.5" stroke-miterlimit="10" d="M157.359,89.26c0.039,0.394,0.145,0.728,0.312,1   c0.17,0.273,0.39,0.496,0.656,0.668c0.266,0.173,0.573,0.298,0.924,0.373c0.351,0.078,0.724,0.117,1.121,0.117   c0.465,0,0.869-0.049,1.207-0.146c0.34-0.102,0.616-0.23,0.83-0.398c0.213-0.168,0.373-0.36,0.473-0.582   c0.103-0.221,0.154-0.453,0.154-0.699c0-0.342-0.093-0.62-0.277-0.834c-0.184-0.211-0.424-0.385-0.721-0.521   c-0.295-0.135-0.636-0.239-1.021-0.321c-0.387-0.082-0.774-0.162-1.182-0.238c-0.401-0.076-0.795-0.17-1.18-0.273   c-0.384-0.105-0.724-0.25-1.021-0.43c-0.295-0.182-0.537-0.41-0.722-0.691s-0.276-0.641-0.276-1.072   c0-0.303,0.075-0.598,0.228-0.883c0.149-0.287,0.375-0.539,0.67-0.762c0.297-0.223,0.668-0.396,1.112-0.525   c0.447-0.131,0.963-0.197,1.542-0.197c0.596,0,1.109,0.07,1.555,0.209c0.439,0.14,0.811,0.328,1.102,0.57   c0.291,0.24,0.51,0.521,0.652,0.84c0.146,0.316,0.221,0.658,0.221,1.017h-0.945c0-0.334-0.071-0.625-0.211-0.869   c-0.143-0.245-0.334-0.442-0.576-0.603c-0.241-0.155-0.519-0.27-0.829-0.342c-0.312-0.074-0.632-0.11-0.962-0.11   c-0.504,0-0.928,0.06-1.272,0.178c-0.346,0.119-0.618,0.271-0.823,0.459c-0.203,0.188-0.345,0.396-0.422,0.625   c-0.078,0.229-0.093,0.459-0.043,0.688c0.059,0.285,0.194,0.517,0.407,0.688c0.213,0.17,0.478,0.312,0.787,0.422   c0.31,0.111,0.651,0.201,1.026,0.271c0.374,0.07,0.754,0.145,1.144,0.222c0.388,0.076,0.765,0.168,1.127,0.274   c0.365,0.105,0.688,0.25,0.97,0.431c0.28,0.179,0.506,0.41,0.676,0.69c0.17,0.281,0.256,0.636,0.256,1.062   c0,0.815-0.336,1.451-1.004,1.899c-0.67,0.447-1.609,0.675-2.822,0.675c-0.543,0-1.05-0.062-1.517-0.179   c-0.465-0.119-0.869-0.299-1.207-0.539c-0.34-0.241-0.604-0.539-0.793-0.896c-0.188-0.354-0.285-0.773-0.285-1.258L157.359,89.26   L157.359,89.26z"/>
	<path stroke="#000000" stroke-width="0.5" stroke-miterlimit="10" d="M165.439,87.497c0-0.646,0.104-1.252,0.312-1.815   c0.207-0.562,0.519-1.056,0.924-1.478c0.406-0.42,0.912-0.754,1.517-0.998c0.604-0.246,1.297-0.369,2.082-0.369   c0.813,0,1.531,0.121,2.146,0.361c0.617,0.24,1.131,0.572,1.543,0.992c0.412,0.422,0.726,0.916,0.935,1.48   c0.207,0.568,0.312,1.178,0.312,1.822c0,0.637-0.104,1.231-0.312,1.795c-0.209,0.562-0.521,1.051-0.926,1.475   c-0.408,0.42-0.916,0.754-1.529,0.996c-0.609,0.244-1.318,0.367-2.125,0.367c-0.81,0-1.517-0.123-2.125-0.367   c-0.611-0.242-1.123-0.576-1.529-0.996c-0.406-0.424-0.713-0.912-0.916-1.475C165.542,88.731,165.439,88.133,165.439,87.497z    M170.333,91.418c0.681,0,1.265-0.106,1.754-0.324c0.49-0.217,0.894-0.506,1.209-0.864c0.313-0.356,0.547-0.772,0.699-1.25   c0.149-0.476,0.226-0.97,0.226-1.479c0-0.613-0.091-1.164-0.269-1.646c-0.181-0.486-0.438-0.9-0.779-1.244   c-0.34-0.346-0.752-0.605-1.237-0.785c-0.484-0.18-1.027-0.271-1.631-0.271c-0.671,0-1.25,0.111-1.74,0.332   c-0.486,0.222-0.894,0.515-1.207,0.875c-0.312,0.363-0.549,0.783-0.697,1.257c-0.15,0.476-0.229,0.969-0.229,1.483   c0,0.521,0.075,1.021,0.229,1.496c0.148,0.473,0.383,0.891,0.697,1.25c0.313,0.357,0.721,0.646,1.207,0.855   C169.055,91.312,169.645,91.418,170.333,91.418z"/>
	<path stroke="#000000" stroke-width="0.5" stroke-miterlimit="10" d="M177.175,91.896V83.07h0.99v8.115h5.621v0.711H177.175z"/>
	<path stroke="#000000" stroke-width="0.5" stroke-miterlimit="10" d="M185.271,91.896V83.07h3.582c0.293,0,0.578,0.009,0.856,0.021   c0.281,0.016,0.562,0.041,0.83,0.086c0.271,0.047,0.537,0.113,0.793,0.203c0.258,0.09,0.508,0.207,0.75,0.354   c0.353,0.213,0.64,0.475,0.856,0.777c0.226,0.307,0.398,0.631,0.531,0.969c0.131,0.34,0.225,0.686,0.275,1.029   c0.055,0.348,0.08,0.668,0.08,0.963s-0.021,0.594-0.064,0.896c-0.043,0.301-0.113,0.598-0.211,0.889   c-0.098,0.289-0.227,0.568-0.387,0.832c-0.16,0.268-0.361,0.51-0.604,0.729c-0.242,0.229-0.509,0.412-0.795,0.552   c-0.285,0.141-0.586,0.248-0.902,0.325c-0.315,0.078-0.643,0.132-0.98,0.158c-0.342,0.026-0.686,0.043-1.035,0.043H185.271   L185.271,91.896z M186.262,91.187h2.374c0.445,0,0.865-0.021,1.261-0.065c0.395-0.045,0.793-0.156,1.201-0.336   c0.348-0.147,0.635-0.351,0.858-0.604c0.224-0.255,0.399-0.529,0.53-0.828c0.132-0.297,0.224-0.606,0.277-0.938   c0.053-0.328,0.076-0.643,0.076-0.942c0-0.318-0.021-0.644-0.068-0.976c-0.049-0.33-0.145-0.646-0.276-0.943   c-0.136-0.299-0.32-0.571-0.554-0.821c-0.234-0.25-0.534-0.455-0.903-0.619c-0.312-0.139-0.679-0.229-1.104-0.271   c-0.429-0.041-0.857-0.061-1.297-0.061h-2.373L186.262,91.187L186.262,91.187z"/>
	<path stroke="#000000" stroke-width="0.5" stroke-miterlimit="10" d="M194.824,91.896l4.119-8.826h1.121l4.021,8.826h-1.021   l-1.209-2.771h-4.773l-1.238,2.771H194.824z M197.416,88.415h4.105l-2.056-4.633L197.416,88.415z"/>
	<path stroke="#000000" stroke-width="0.5" stroke-miterlimit="10" d="M205.498,91.896V83.07h3.582c0.291,0,0.576,0.009,0.857,0.021   c0.278,0.016,0.559,0.041,0.83,0.086c0.271,0.047,0.533,0.113,0.793,0.203c0.258,0.09,0.508,0.207,0.75,0.354   c0.352,0.213,0.637,0.475,0.856,0.777c0.226,0.307,0.397,0.631,0.531,0.969c0.131,0.34,0.223,0.686,0.274,1.029   c0.053,0.348,0.08,0.668,0.08,0.963s-0.021,0.594-0.064,0.896c-0.043,0.301-0.112,0.598-0.213,0.889   c-0.098,0.289-0.225,0.568-0.385,0.832c-0.16,0.268-0.361,0.51-0.604,0.729c-0.242,0.229-0.508,0.412-0.793,0.552   c-0.287,0.141-0.588,0.248-0.9,0.325c-0.316,0.078-0.646,0.132-0.984,0.158c-0.338,0.026-0.685,0.043-1.03,0.043H205.498   L205.498,91.896z M206.486,91.187h2.373c0.447,0,0.867-0.021,1.262-0.065c0.393-0.045,0.793-0.156,1.199-0.336   c0.352-0.147,0.637-0.351,0.859-0.604c0.221-0.255,0.397-0.529,0.528-0.828c0.131-0.297,0.226-0.606,0.274-0.938   c0.056-0.328,0.08-0.643,0.08-0.942c0-0.318-0.022-0.644-0.069-0.976c-0.052-0.33-0.146-0.646-0.277-0.943   c-0.132-0.299-0.317-0.571-0.553-0.821s-0.535-0.455-0.901-0.619c-0.312-0.139-0.683-0.229-1.105-0.271   c-0.428-0.041-0.859-0.061-1.297-0.061h-2.373V91.187L206.486,91.187z"/>
	<path stroke="#000000" stroke-width="0.5" stroke-miterlimit="10" d="M215.602,87.497c0-0.646,0.104-1.252,0.313-1.815   c0.207-0.562,0.517-1.056,0.924-1.478c0.408-0.42,0.912-0.754,1.515-0.998c0.604-0.246,1.297-0.369,2.082-0.369   c0.815,0,1.53,0.121,2.147,0.361s1.131,0.572,1.543,0.992c0.414,0.422,0.726,0.916,0.933,1.48c0.209,0.568,0.313,1.178,0.313,1.822   c0,0.637-0.104,1.231-0.313,1.795c-0.207,0.562-0.517,1.051-0.924,1.475c-0.408,0.42-0.919,0.754-1.529,0.996   c-0.607,0.244-1.316,0.367-2.125,0.367c-0.808,0-1.515-0.123-2.127-0.367c-0.607-0.242-1.121-0.576-1.525-0.996   c-0.408-0.424-0.717-0.912-0.918-1.475C215.705,88.731,215.602,88.133,215.602,87.497z M220.494,91.418   c0.68,0,1.266-0.106,1.756-0.324c0.49-0.217,0.893-0.506,1.207-0.864c0.314-0.356,0.549-0.772,0.699-1.25   c0.15-0.476,0.227-0.97,0.227-1.479c0-0.613-0.09-1.164-0.271-1.646c-0.18-0.486-0.438-0.9-0.775-1.244   c-0.34-0.346-0.752-0.605-1.234-0.785c-0.486-0.18-1.029-0.271-1.635-0.271c-0.67,0-1.25,0.111-1.736,0.332   c-0.49,0.222-0.896,0.515-1.209,0.875c-0.313,0.363-0.549,0.783-0.699,1.257c-0.149,0.476-0.229,0.969-0.229,1.483   c0,0.521,0.076,1.021,0.229,1.496c0.15,0.473,0.386,0.891,0.699,1.25c0.312,0.357,0.719,0.646,1.209,0.855   C219.214,91.312,219.805,91.418,220.494,91.418z"/>
	<path stroke="#000000" stroke-width="0.5" stroke-miterlimit="10" d="M228.312,87.888v4.01l-0.988-0.015V83.07h4.105   c1.151,0,2.034,0.185,2.646,0.548c0.608,0.36,0.918,0.952,0.918,1.771c0,0.557-0.136,0.996-0.397,1.322   c-0.271,0.328-0.701,0.604-1.306,0.834c0.312,0.09,0.556,0.223,0.729,0.395s0.308,0.367,0.394,0.588   c0.088,0.223,0.146,0.453,0.168,0.699c0.022,0.242,0.041,0.48,0.051,0.711c0.013,0.336,0.027,0.611,0.054,0.834   c0.022,0.223,0.053,0.398,0.086,0.539c0.035,0.141,0.076,0.248,0.125,0.322c0.049,0.078,0.104,0.139,0.174,0.18v0.072l-1.092,0.014   c-0.105-0.146-0.185-0.354-0.228-0.611c-0.043-0.262-0.078-0.535-0.104-0.82c-0.022-0.286-0.043-0.562-0.058-0.834   c-0.017-0.271-0.043-0.487-0.079-0.661c-0.06-0.236-0.154-0.427-0.285-0.568c-0.131-0.146-0.289-0.252-0.474-0.323   c-0.187-0.074-0.392-0.123-0.618-0.146c-0.229-0.021-0.464-0.035-0.705-0.035h-3.117v-0.008h0.002V87.888z M231.4,87.176   c0.367,0,0.711-0.03,1.022-0.098c0.315-0.063,0.593-0.17,0.822-0.312c0.231-0.146,0.418-0.326,0.555-0.545   c0.138-0.223,0.203-0.486,0.203-0.801c0-0.324-0.067-0.596-0.211-0.809c-0.144-0.214-0.33-0.382-0.565-0.503   c-0.238-0.122-0.513-0.209-0.814-0.26c-0.307-0.05-0.623-0.07-0.953-0.07h-3.146v3.396L231.4,87.176L231.4,87.176z"/>
	<path stroke="#000000" stroke-width="0.5" stroke-miterlimit="10" d="M236.089,91.896l4.119-8.826h1.121l4.021,8.826h-1.021   l-1.209-2.771h-4.774l-1.238,2.771H236.089z M238.682,88.415h4.104l-2.054-4.633L238.682,88.415z"/>
	<path stroke="#000000" stroke-width="0.5" stroke-miterlimit="10" d="M247.169,89.26c0.039,0.394,0.144,0.728,0.312,1   c0.17,0.273,0.392,0.496,0.656,0.668c0.266,0.173,0.574,0.298,0.924,0.373c0.353,0.078,0.726,0.117,1.121,0.117   c0.467,0,0.867-0.049,1.209-0.146c0.34-0.102,0.615-0.23,0.83-0.398c0.213-0.168,0.369-0.36,0.473-0.582   c0.104-0.221,0.152-0.453,0.152-0.699c0-0.342-0.092-0.62-0.275-0.834c-0.186-0.211-0.426-0.385-0.721-0.521   c-0.297-0.135-0.637-0.239-1.021-0.321s-0.774-0.162-1.181-0.238c-0.401-0.076-0.797-0.17-1.18-0.273   c-0.385-0.105-0.725-0.25-1.021-0.43c-0.297-0.182-0.535-0.41-0.723-0.691c-0.187-0.281-0.273-0.641-0.273-1.072   c0-0.303,0.072-0.598,0.227-0.883c0.148-0.287,0.372-0.539,0.67-0.762c0.297-0.223,0.668-0.396,1.111-0.525   c0.447-0.131,0.961-0.197,1.545-0.197c0.594,0,1.105,0.07,1.553,0.209c0.439,0.14,0.81,0.328,1.101,0.57   c0.291,0.24,0.51,0.521,0.653,0.84c0.146,0.316,0.22,0.658,0.22,1.017h-0.945c0-0.334-0.069-0.625-0.211-0.869   c-0.144-0.245-0.334-0.442-0.576-0.603c-0.241-0.153-0.521-0.27-0.829-0.342c-0.312-0.074-0.632-0.11-0.962-0.11   c-0.504,0-0.93,0.06-1.272,0.178c-0.342,0.119-0.617,0.271-0.82,0.459s-0.346,0.396-0.423,0.625s-0.093,0.459-0.043,0.688   c0.058,0.285,0.192,0.517,0.405,0.688c0.215,0.17,0.479,0.312,0.787,0.422c0.311,0.111,0.651,0.201,1.024,0.271   s0.754,0.145,1.146,0.222c0.388,0.076,0.766,0.168,1.127,0.274c0.362,0.105,0.688,0.25,0.97,0.431   c0.28,0.179,0.509,0.41,0.679,0.69c0.17,0.281,0.254,0.636,0.254,1.062c0,0.815-0.334,1.451-1.004,1.899   c-0.67,0.449-1.609,0.675-2.822,0.675c-0.547,0-1.051-0.062-1.518-0.179c-0.467-0.119-0.869-0.299-1.207-0.539   c-0.344-0.241-0.604-0.539-0.795-0.896c-0.188-0.355-0.283-0.773-0.283-1.258L247.169,89.26L247.169,89.26z"/>
</g>
<line fill="none" stroke="#000000" stroke-miterlimit="10" x1="61" y1="78.5" x2="254" y2="78.5"/>
<line fill="none" stroke="#000000" stroke-miterlimit="10" x1="151" y1="96.5" x2="255" y2="96.5"/>
</svg>';

session_start();
if (isset($_SESSION['s_username'])) {
$mensaje1="Bienvenido ".$_SESSION['s_username'].", has ingresado a Miller";

if($_SESSION['tipo_usuario']==1){
	$nav='<nav>
<ul class="nav">
<li><a class="a_menu" href="consulta_producto.php">Productos</a></li>
<li><a class="a_menu" href="consulta_cliente.php">Clientes</a></li>
<li><a class="a_menu" href="consulta_proveedor.php">Proveedores</a> </li>
<li><a class="a_menu" href="comisiones.php">Comisiones</a></li>
</ul>
</nav>';
	}
}else{
header("Location: ../login.php");
}
?>