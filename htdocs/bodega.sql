-- phpMyAdmin SQL Dump
-- version 3.3.9.2
-- http://www.phpmyadmin.net
--
-- Servidor: localhost
-- Tiempo de generación: 25-07-2012 a las 12:55:07
-- Versión del servidor: 5.5.9
-- Versión de PHP: 5.3.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de datos: `bodega`
--

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `cliente`
--

CREATE TABLE `cliente` (
  `id_cliente` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre_cliente` varchar(50) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `rut` varchar(15) NOT NULL,
  `telefono` varchar(20) NOT NULL,
  `direccion` text NOT NULL,
  `giro` text NOT NULL,
  `comuna` varchar(30) NOT NULL,
  `cod_vendedor` int(3) unsigned NOT NULL,
  PRIMARY KEY (`id_cliente`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=148 ;

--
-- Volcar la base de datos para la tabla `cliente`
--

INSERT INTO `cliente` VALUES(1, 'a & a ingenieria y mecanica integral ltda', '77.268.280-8', 'no ingresado', 'callejon diego de almagro 560', 'ingenieria.', 'copiapo, 3Âª regiÃ³n', 1);
INSERT INTO `cliente` VALUES(2, 'acetogen gas chile s.a.', '93.333.000-1', '3902600', 'juana weber #4619', 'importacion y exportacion', 'estacion central', 1);
INSERT INTO `cliente` VALUES(3, 'agricola quintanilla & jorquera ltda', '76.021.157-5', '67285358', 'fundo manantiales camino a caren s/n', 'agricola', 'san francisco mostaz', 1);
INSERT INTO `cliente` VALUES(4, 'abastecedora importadora tecnica ltda', '78.103.880-6', '6354048', 'fray camilo henriquez 1043', 'importacion elementos izaje', 'santiago', 1);
INSERT INTO `cliente` VALUES(5, 'agas limitada', '88.620.500-7', '72 222221', 'san martin 250', 'distribucion', 'rancagua', 1);
INSERT INTO `cliente` VALUES(6, 'alberto castillo cortes', '14.113.254-7', '55 931 038', 'luis lingn #8486', 'prestador de servicios marÃ­timos ', 'antofagasta', 1);
INSERT INTO `cliente` VALUES(7, 'bernardia aros espinoza', '09.143.404-0', '97566981', 'rendic 5666', 'comercializadora', 'antofagasta', 1);
INSERT INTO `cliente` VALUES(8, 'besalco maquinarias s. a.', '79.633.220-4', '5590405', 'j.j. prieto 9660', 'arriendo de maquinarias', 'el bosque', 1);
INSERT INTO `cliente` VALUES(9, 'c.v.c. comao servicios integrales', '76.087.604-6', '78634156', 'independencia 2156', 'servicios integrales', 'valparaiso', 1);
INSERT INTO `cliente` VALUES(10, 'camila moreno', '17.168.823-K', '5556066', 'cuevas 1245', 'contadora', 'santiago', 1);
INSERT INTO `cliente` VALUES(11, 'canmetal ltda.', '76.564.440-2', '8520406', 'las acacias # 2339', 'metalmecanica', 'la pintana', 1);
INSERT INTO `cliente` VALUES(12, 'carlos brito', '08.997.357-0', '91520705', 'conde duque 1864', '', 'calama', 1);
INSERT INTO `cliente` VALUES(13, 'carlos diaz baez', '07.313.043-3', '7736496', 'julio baã‘ado 1958', 'fab. art. metalicos y goma', 'quinta normal', 1);
INSERT INTO `cliente` VALUES(27, 'cical construccion ong.ltda.', '78.125.140-2', '', 'puerto santiago 180', 'ing.y construccion', 'pudahuel', 1);
INSERT INTO `cliente` VALUES(28, 'comercial e industrial itaka ltda', '76.683.270-9', '5962384', 'av. pedro aguirre cerda 4733', 'importacion maquinaria', 'cerrillos', 1);
INSERT INTO `cliente` VALUES(29, 'comercializadora codearc ltda', '76.096.864-1', '78772653', 'av mexico 9474', 'comercializadora', 'la florida', 1);
INSERT INTO `cliente` VALUES(30, 'comercializadora e inversiones andes s.a.', '76.108.798-3', '6523405', 'sant alejandra #03521', 'fabricacion de productos metal', 'san bernardo', 1);
INSERT INTO `cliente` VALUES(31, 'constructora incolur iecsa ltda', '77.913.240-4', '9253100', 'napoleon  # 3010  piso 6', 'constructora', 'las condes', 1);
INSERT INTO `cliente` VALUES(32, 'constructora padilla ltda', '76.345.650-1', '', 'calle nro 7 nro 0189 e 10', 'construccion', 'quilpue', 1);
INSERT INTO `cliente` VALUES(33, 'carlos meyer daza', '08.099.972-0', '5274543', 'ismael tocornal 8786', 'taller de galvanoplastia', 'san ramon', 1);
INSERT INTO `cliente` VALUES(34, 'carlos pavez garay', '07.817.162-6', '6820411', 'matucana 61-c loc 66-68-35', 'ferreteria', 'santiago', 1);
INSERT INTO `cliente` VALUES(35, 'carmen suarez puga', '13.272.961-1', '7387879', 'panamericana norte km 19 1/2', 'ferreteria', 'colina', 1);
INSERT INTO `cliente` VALUES(36, 'comercial e industrial cimex ltda', '76.387.300-5', '5560550', 'aracena infante 170-b', 'comercializadora de prod. ferr', 'santiago', 1);
INSERT INTO `cliente` VALUES(37, 'comercial e industrial isesa s. a.', '95.050.000-K', '3627000', 'av pedro aguirre cerda 4693', 'productora comercializadora ar', 'cerrillos', 1);
INSERT INTO `cliente` VALUES(38, 'comercializadora vendaris welding ltda', '76.852.880-2', '', 'sebastopol 585', 'comercializadora', 'san miguel', 1);
INSERT INTO `cliente` VALUES(39, 'constructora herrera y asociados ltda', '78.852.710-1', '4819600', 'los manzanos 2664', 'constructora', 'la pintana', 1);
INSERT INTO `cliente` VALUES(40, 'constructora remoc ltda', '77.449.220-8', '6328140', 'moneda 611 oficina 62', 'constructora', 'santiago', 1);
INSERT INTO `cliente` VALUES(41, 'corporacion nacional del cobre de chile division', '61.704.000-K', '', 'av. bernardo oâ´higgins 103', 'codelco', 'el salvador', 1);
INSERT INTO `cliente` VALUES(42, 'cristian valencia riquelme', '10.712.843-3', '', 'galvarino 1552', 'transporte', 'estacion central', 1);
INSERT INTO `cliente` VALUES(43, 'denys veronica sanchez s.', '10.448.955-9', '09/2514514', 'avda. ossa 0770', 'ferreteria', 'la cisterna', 1);
INSERT INTO `cliente` VALUES(44, 'dionicio pino yaã±ez', '06.382.515-8', '6469549', 'jorge irmas 3193', 'metalurgica', 'renca', 1);
INSERT INTO `cliente` VALUES(45, 'diproima s. a.', '99.515.680-6', '931038', 'cobija 320', 'distribuidora de pintura', 'antofagasta', 1);
INSERT INTO `cliente` VALUES(46, 'duramet s. a.', '81.567.400-6', '8571408', 'av. portales 2370', 'estructuras de acero', 'san bernardo', 1);
INSERT INTO `cliente` VALUES(47, 'emilio lujan lujan', '04.550.010-1', '6883817', 'diez de julio # 1640', 'industria', 'santiago', 1);
INSERT INTO `cliente` VALUES(48, 'empresa de obras y montajes ovalle moore s.a.', '80.707.200-5', '9490816', 'avda.americo vespucio # 2680 ofic.45', 'construccion y montajes', 'conchali', 1);
INSERT INTO `cliente` VALUES(49, 'empresa de transporte de pasajeros metro s. a.', '61.219.000-3', '3651546', 'alameda 1414', 'transporte terrestre pasajeros', 'santiago', 1);
INSERT INTO `cliente` VALUES(50, 'empresa de mant. de equipos de chancado mech ltda', '76.013.993-9', '8528432', 'el mariscal 2140', 'mantencion', 'la pintana', 1);
INSERT INTO `cliente` VALUES(51, 'enami planta', '61.703.000-4', '52 444 100', 'condell sin numero', 'mineria', 'chaã±aral', 1);
INSERT INTO `cliente` VALUES(52, 'esmetal metalurgica ltda', '79.930.910-6', '8341437', 'av. las industrias 1440', 'estructuras metalicas-proyecto', 'padre hurtado', 1);
INSERT INTO `cliente` VALUES(53, 'fe grande maquinarias y servicios s. a.', '99.541.860-6', '27701200', 'avenida las parcelas 7950', 'maquinarias y servicios', 'peã‘alolen', 1);
INSERT INTO `cliente` VALUES(54, 'fluitek chile s.a.', '96.946.910-3', '9582300', 'avda. kennedy 6690 of. 01', 'compra y venta de repuestos', 'vitacura', 1);
INSERT INTO `cliente` VALUES(55, 'francisco cifuentes huechullan', '12.210.998-4', '78523515', 'pasaje pocatello 211', 'contratista', 'lo prado', 1);
INSERT INTO `cliente` VALUES(56, 'ferreteria galiano', '77.465.560-3', '5636667', 'caros valdovino 1989', 'ferreteria', 'pedro aguirre cerda', 1);
INSERT INTO `cliente` VALUES(57, 'ferreteria santiago s. a.', '91.361.000-8', '7313800', 'lira 919', 'ferreteria', 'santiago', 1);
INSERT INTO `cliente` VALUES(58, 'guillermo mancilla olave', '05.972.543-2', '', 'valdivia 5714', 'transporte y arriendo automoviles', 'antofagasta', 1);
INSERT INTO `cliente` VALUES(59, 'gabriel arriagada', '12.072.310-3', '082394539', 'calle 61 1446 villa los arrieta', 'articulos de ferreteria', 'peã±alolen', 1);
INSERT INTO `cliente` VALUES(60, 'hernan elias gonzalez', '08.449.525-5', '7764753', 'hogar de cristo 3545', 'refrigeracion para transporte', 'estacion central', 1);
INSERT INTO `cliente` VALUES(61, 'hamid araya huerta', '06.658.918-8', '2725936', 'los espinos 3595', 'estructuras metalicas', 'macul', 1);
INSERT INTO `cliente` VALUES(62, 'industrial y comercial valencia s.a.', '96.946.410-1', '8161000', 'avda.padre alberto hurtado # 1267', 'metalmecanica', 'estacion central', 1);
INSERT INTO `cliente` VALUES(63, 'ingedef limitada', '76.290.980-4', '7470127', 'puerto vespucio 0132', 'construccion', 'pudahuel', 1);
INSERT INTO `cliente` VALUES(64, 'ingemm ingenieria', '76.045.563-6', '9832553', 'av ricardo lyon', 'construccion', 'ã‘uã‘oa', 1);
INSERT INTO `cliente` VALUES(65, 'importadora de insumos para la industria ltda', '76.073.171-4', '90809060', 'pasaje quila 3658', 'importadora', 'maipu', 1);
INSERT INTO `cliente` VALUES(66, 'ind. nacional implementacion deportiva', '79.942.060-0', '68353228', 'los paltos 2795', 'industria', 'la pintana', 1);
INSERT INTO `cliente` VALUES(67, 'industria metalurgica aconcagua ltda', '83.732.700-8', '34  515983', 'molina 140', 'fabrica de muebles funcionales', 'san felipe', 1);
INSERT INTO `cliente` VALUES(68, 'ingenieria construcciones roljoc s. a.', '76.765.990-3', '3610922', 'valentin letelier 1373 of 711', 'ingenieria construccion', 'santiago', 1);
INSERT INTO `cliente` VALUES(69, 'jjo herrera limitada', '76.051.713-5', '9266359', 'tres punta # 2690', 'construcciones menores', 'pedro aguirre cerda', 1);
INSERT INTO `cliente` VALUES(70, 'jonatan peralta caro', '22.232.218-9', '', 'pasaje 11 enero 1217', '', 'estacion central', 1);
INSERT INTO `cliente` VALUES(71, 'jrp ingenieria y construccion ltda.', '77.387.860-9', '2045002', 'irarrazaval 2821 oficina 1323', 'construccion', 'ã‘uã‘oa', 1);
INSERT INTO `cliente` VALUES(72, 'juan carlos salas novoa', '09.734.299-7', '071214348', 'pasaje dos y media poniente 2234', 'contratista', 'talca', 1);
INSERT INTO `cliente` VALUES(73, 'jorge rabie y cia s. a.', '81.788.500-4', '6113100', 'camino melipilla 15000', 'distribuidora', 'maipu', 1);
INSERT INTO `cliente` VALUES(74, 'jose avalos mora', '05.982.236-5', '', 'lautaro espindola 7024', 'maestranza', 'antofagasta', 1);
INSERT INTO `cliente` VALUES(75, 'juan mancilla olave', '07.964.925-2', '', 'radomiro tomic 7187', 'maestranza', 'antofagasta', 1);
INSERT INTO `cliente` VALUES(76, 'karina cornejo varas', '13.019.848-1', '032-320364', 'hualqui 740 puerto marino tres', 'com. de insumos industriales', 'el belloto quilpue', 1);
INSERT INTO `cliente` VALUES(77, 'kupfer hermanos s. a.', '90.844.000-5', '3515000', 'libertad 58', 'dist. fabricacion y representa', 'santiago', 1);
INSERT INTO `cliente` VALUES(78, 'luis rozas donoso', '07.573.426-3', '8526718', 'los olmos #2394', 'est.metalicas', 'la pintana', 1);
INSERT INTO `cliente` VALUES(79, 'luis bustamante zeguers', '03.681.705-4', '6838066', 'san borja 1368', 'accesorios e implementacion pa', 'estacion central', 1);
INSERT INTO `cliente` VALUES(80, 'luis pando cantin', '04.887.013-9', '2221497', 'san francisco 990', 'panaderia', 'santiago', 1);
INSERT INTO `cliente` VALUES(81, 'm y h comercial e industrial limitada', '80.642.800-0', '6241010', 'av. pdte. eduardo frei montalva 4800', 'fabricacion y comercializacion', 'renca', 1);
INSERT INTO `cliente` VALUES(82, 'maestranza joma s.a.', '84.056.400-2', '6361100', 'empresario juan luis contreras madrid 0525', 'maestranza', 'san bernardo', 1);
INSERT INTO `cliente` VALUES(83, 'mario monardes gonzalez', '09.081.611-K', '', 'iquique 6072', 'maestranza', 'antofagasta', 1);
INSERT INTO `cliente` VALUES(84, 'mauricio lhoest torres', '12.523.755-K', '7795630', 'ruiz tagle 714', '', 'estacion central', 1);
INSERT INTO `cliente` VALUES(85, 'minepartner ltda', '76.083.165-4', '55 423514', 'mario silva iriarte 572', 'importacion insumos para la mineria', 'sector la chimba', 1);
INSERT INTO `cliente` VALUES(86, 'muebles olga veliz y cia. ltda.', '76.016.890-4', '6419174', 'av.jorge hirmas 3183', 'muebles', 'renca', 1);
INSERT INTO `cliente` VALUES(87, 'maestranza dionisio pino ltda', '76.058.053-8', '', 'jorge irmas 3193', 'maestranza', 'renca', 1);
INSERT INTO `cliente` VALUES(88, 'maestranza tecnica matec ltda', '77.695.380-6', '4960404', 'santa florencia 851', 'maestranza', 'san bernardo', 1);
INSERT INTO `cliente` VALUES(89, 'maestranza vic- mar ltda', '78.637.890-7', '281800', 'avenida arrayan 162', 'maestranza', 'calera', 1);
INSERT INTO `cliente` VALUES(90, 'marco ogaz rosel', '09.019.286-8', '6695080', 'las encinas 1791', 'estructuras metalicas', 'renca', 1);
INSERT INTO `cliente` VALUES(91, 'mario urrutia muã±oz', '09.570.972-9', '85042378', 'quebrada de umallani 1062', 'estructuras metalicas', 'peã±alolen', 1);
INSERT INTO `cliente` VALUES(92, 'mauricio hochschild ingeniera y servicios s. a.', '96.885.630-8', '4736600', 'avda senador aime guzman errazuriz 3527', 'importadores distribuidores', 'renca', 1);
INSERT INTO `cliente` VALUES(93, 'maxmin ingenieria y servicios limitada', '77.662.820-4', '7737296', 'radal 742', 'fabricacion', 'santiago', 1);
INSERT INTO `cliente` VALUES(94, 'metalmecanica tormetal ltda', '78.991.830-9', '689700', 'montegrande 323', 'metalmecanica', 'antofagasta', 1);
INSERT INTO `cliente` VALUES(95, 'metalurgica lima limitada', '78.960.890-3', '9452911', 'capitan avalos 14', 'metalurgica', 'el bosque', 1);
INSERT INTO `cliente` VALUES(96, 'metalurgica puerto caldera ltda', '96.795.410-1', '52 525672', 'diego de almeida 905', 'metalurgica', 'copiapo', 1);
INSERT INTO `cliente` VALUES(97, 'miguel saavedra', '07.160.205-2', '88462439', 'san jose de las rosas 1324', '', 'estacion central', 1);
INSERT INTO `cliente` VALUES(98, 'minetec s. a.', '76.009.926-0', '', 'av. americo vespucio 2101', 'mineria', 'quilicura', 1);
INSERT INTO `cliente` VALUES(99, 'monasterio hermanos', '81.566.200-8', '', 'gran avenida 9267', 'ferreteria', 'la cisterna', 1);
INSERT INTO `cliente` VALUES(100, 'nisi ingenieria ltda', '76.448.270-0', '789567', 'carlos aguirre luco 0264', 'ingenieria', 'puente alto', 1);
INSERT INTO `cliente` VALUES(101, 'nuã‘â‘ez y santin y cia ltda', '77.189.090-3', '7788058', 'ruiz tagle 589', 'transporte', 'estacion central', 1);
INSERT INTO `cliente` VALUES(102, 'onell y compaãƒâ‘ia limitada', '50.070.250-8', '5210031', 'jose joaquin prieto 5221', 'gases industriales e insumos', 'pedro aguirre cerda', 1);
INSERT INTO `cliente` VALUES(103, 'otero y dominguez limitada', '88.855.300-2', '4446900', '10 de julio', 'aceros y herramientas', 'santiago', 1);
INSERT INTO `cliente` VALUES(104, 'pedro felipe pavez lizana', '04.634.575-4', '8571729', 'avda. portales 1330', 'ferreteria', 'san bernardo', 1);
INSERT INTO `cliente` VALUES(105, 'pedro millar sanchez', '05.675.237-4', '8535598', 'uruguay 0915', 'taller', 'puente alto', 1);
INSERT INTO `cliente` VALUES(106, 'perez y klein limitada', '76.067.175-4', '', 'coquimbo 332', 'servicio tecnico', 'santiago', 1);
INSERT INTO `cliente` VALUES(107, 'pesamatic s.a.', '80.975.200-3', '7904000', 'ernesto pinto nâº148', 'pesaje', 'recoleta', 1);
INSERT INTO `cliente` VALUES(108, 'raul saavedra m', '06.017.610-8', '', 'parque industrial la chimba g-5', 'reparacion y mantencion', 'antofagasta', 1);
INSERT INTO `cliente` VALUES(109, 'raãƒâšl alberto hernandez arancibia', '09.973.473-6', '74438182', 'yecora # 898', 'construccion y mantencion', 'melipilla', 1);
INSERT INTO `cliente` VALUES(110, 'rm construcciones e.i.r.l.', '52.004.486-8', '8858201', 'eizaguirre 565 b', 'construcciones', 'san bernardo', 1);
INSERT INTO `cliente` VALUES(111, 'robinson muãƒâ‘oz velasquez', '13.547.237-9', '84398305', 'parela nâº 10 pabellon', 'metalmecanica', 'melipilla', 1);
INSERT INTO `cliente` VALUES(112, 'rosa arancibia vera', '12.601.545-3', '83636147', 'parcela 65 cruce el cobre el melon', 'constratista  sub constratista', 'nogales', 1);
INSERT INTO `cliente` VALUES(113, 'raquel acevedo  t', '02.624.077-8', '', 'sargente menadier # 0321', 'servicios automotriz y ventas', 'puente alto', 1);
INSERT INTO `cliente` VALUES(114, 'ricardo fuentes cofre', '16.028.643-1', '8480131', 'luis pezoa veliz 0287', 'construccion en estructuras metalicas', 'puente alto', 1);
INSERT INTO `cliente` VALUES(115, 'roberto arevalo s. a.', '99.566.800-9', '6523400', 'santa alejandra 3530', 'metalurgica', 'san bernardo', 1);
INSERT INTO `cliente` VALUES(116, 'roberto navarro gallardo', '09.785.020-8', '2765792', 'av. americo vespucio 1166', 'comercializadora', 'peã±alolen', 1);
INSERT INTO `cliente` VALUES(117, 'ruben orellana vera', '11.883.844-0', '5594072', 'salas 8831', 'mantencion', 'la cisterna', 1);
INSERT INTO `cliente` VALUES(118, 'schaffner s. a.', '89.091.900-6', '5602600', 'padre vicente irarrazabal 899', '', 'estacion central', 1);
INSERT INTO `cliente` VALUES(119, 'schultz, ingenieria y maquinaria ltda', '79.624.430-5', '4951400', 'avda el retiro 1247 enea', 'ingenieria y construccion', 'pudahuel', 1);
INSERT INTO `cliente` VALUES(120, 'servicios de gruas carmona ltda', '78.627.780-9', '55-556151', 'el yodo 8170', 'arriendo de gruas y transporte', 'antofagasta', 1);
INSERT INTO `cliente` VALUES(121, 'servindustrial  ltda', '79.571.390-5', '55-23154', 'el salitre # 8030', 'fabricacion de est,depos,recp.', 'antofagasta', 1);
INSERT INTO `cliente` VALUES(122, 'sandvik mining & constru. chile s. a.', '96.728.780-6', '6760285', 'av. pte eduardo frei montalva 9990', 'importaciã³n , exportaciã³n de r', 'quilicura', 1);
INSERT INTO `cliente` VALUES(123, 'segundo toro y cia ltda', '76.096.970-2', '5277954', 'av. lo espejo 0859', 'diseã±o elaboracion muebles', 'el bosque', 1);
INSERT INTO `cliente` VALUES(124, 'sermineros ltda', '76.117.120-8', '7385741', 'la estera 791 parq. ind. valle grande lampa', 'maestranza', 'lampa', 1);
INSERT INTO `cliente` VALUES(125, 'servicios metalmecanico y rep. adrimar ltda', '76.043.917-7', '35 288 489', 'parinacota 2019', 'servicios metalmecanica', 'san antonio', 1);
INSERT INTO `cliente` VALUES(126, 'servicios de mantenciã³n y fabricaciã³n industrial', '77.847.540-5', '72 765417', 'centenario 70', 'servicios', 'rancagua', 1);
INSERT INTO `cliente` VALUES(127, 'servimet limitada', '76.233.350-3', '7591287', 'dr. amador neghme 03639 mod. 81', 'fab. montaje de estructura met', 'la pintana', 1);
INSERT INTO `cliente` VALUES(128, 'soc. comer. y recup. de exedentes industriales spa', '76.096.962-1', '6033940', 'guillermo gallardo 166 602', 'comercializadora de exedente i', 'puerto montt', 1);
INSERT INTO `cliente` VALUES(129, 'sociedad comercial inges chile', '76.374.500-7', '52  212831', 'atacama 581', 'maestranza', 'copiapo', 1);
INSERT INTO `cliente` VALUES(130, 'sociedad comercial e industrial zargo ltda', '77.514.820-9', '52 352 816', 'panamericana sur k 800', 'maestranza', 'copiapo', 1);
INSERT INTO `cliente` VALUES(131, 'soldaduras soltec limitada', '76.488.020-K', '5572465', 'piloto lazo 90', 'soldadura', 'cerrillos', 1);
INSERT INTO `cliente` VALUES(132, 'stanmetal ltda', '76.028.580-3', '', 'nucleo industrial sur modulo 57', 'estructuras metalicas', 'la pintana', 1);
INSERT INTO `cliente` VALUES(133, 'tecaseb ltda', '77.459.560-0', '', 'bulnes 98', 'ferreteria', 'concepcion', 1);
INSERT INTO `cliente` VALUES(134, 'techint chile s. a.', '91.426.000-0', '3633200', 'rosario norte 530 piso 18', 'ingenieria y construccion', 'las condes', 1);
INSERT INTO `cliente` VALUES(135, 'tecnasic s. a.', '96.917.120-1', '4833800', 'carlos justiniano', 'ingenieria y construccion', 'providencia', 1);
INSERT INTO `cliente` VALUES(136, 'ulises castillo barriga', '08.716.808-5', '83445725', 'pasaje 440   #7640', 'particular', 'peã‘alolen', 1);
INSERT INTO `cliente` VALUES(137, 'ulmen s.a', '96.982.420-5', '8542830', 'santa margarita # 01667', 'industria', 'san bernardo', 1);
INSERT INTO `cliente` VALUES(138, 'vega y tejo ltda.', '76.130.803-3', '5256857', 'jose ureta 1148', 'fabrica de muebles de madera y', 'la cisterna', 1);
INSERT INTO `cliente` VALUES(139, 'victor galleguillos cortes', '05.985.582-4', '', 'pasaje 3 acequia # 6578 poblacion enpalme', 'contratista', 'antofagasta', 1);
INSERT INTO `cliente` VALUES(140, 'victor manuel astudillo robles', '08.600.490-9', '32 2817419', 'calle doce 505', 'distribuidor', 'con con', 1);
INSERT INTO `cliente` VALUES(141, 'vecchiola s. a.', '87.049.000-3', '52 203100', 'panamericana norte km 809', '', 'copiapo', 1);
INSERT INTO `cliente` VALUES(142, 'villar hermanos s.a.', '81.756.300-7', '331000', 'av. libertador bernardo oâ´higgisn 2259', 'ferreteria industrial', 'santiago centro', 1);
INSERT INTO `cliente` VALUES(143, 'villela s. a.', '85.845.500-6', '6969709', 'vergara 707', 'mayorista articulos de ferrete', 'santiago', 1);
INSERT INTO `cliente` VALUES(144, 'zambon & zambon s. a.', '77.247.510-1', '8540420', 'avda. lo sierra 02726', 'metalmecanica', 'san bernardo', 1);
INSERT INTO `cliente` VALUES(145, 'zoila loreto alvarez alvarez', '13.240.481-K', '08 1946026', 'patricio edwards nâº 1423', 'construccion', 'pudahuel', 1);
INSERT INTO `cliente` VALUES(146, 'construccion y montajes indust.ocegtel s.a', '88.500.000-2', '368000', 'potrerillos #4383 barrio industrial', 'construccion y montajes', 'calama', 1);
INSERT INTO `cliente` VALUES(147, 'guillermo peralta villalobos.', '16.428.526-k', '8-8971132', 'psje. san clemente #2936, villa pamela', 'desarrollador', 'maipÃº', 1);

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `factura`
--

CREATE TABLE `factura` (
  `id_factura` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `folio` int(10) unsigned NOT NULL,
  `id_cliente` int(10) unsigned NOT NULL,
  `id_producto` int(10) unsigned NOT NULL,
  `cantidad` int(15) unsigned NOT NULL,
  `id_vendedor` int(10) unsigned NOT NULL,
  `fecha` date NOT NULL,
  `condiciones` text NOT NULL,
  `orden_compra` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id_factura`),
  KEY `id_cliente` (`id_cliente`,`id_producto`,`id_vendedor`),
  KEY `id_cliente_2` (`id_cliente`),
  KEY `id_producto` (`id_producto`),
  KEY `id_vendedor` (`id_vendedor`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- Volcar la base de datos para la tabla `factura`
--


-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `producto`
--

CREATE TABLE `producto` (
  `id_producto` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `codigo` varchar(17) NOT NULL COMMENT 'codigo de barras',
  `numero_parte` varchar(30) NOT NULL,
  `cantidad` int(10) NOT NULL,
  `marca` varchar(30) NOT NULL,
  `numero_serie` int(20) NOT NULL,
  `precio_compra` varchar(20) NOT NULL DEFAULT '$ ',
  `precio_venta` varchar(20) NOT NULL DEFAULT '$ ',
  `proveedor` varchar(30) NOT NULL,
  `fecha_ingreso` date NOT NULL,
  `posicion` varchar(8) NOT NULL,
  `nombre` varchar(30) NOT NULL,
  `sucursal` varchar(15) NOT NULL,
  PRIMARY KEY (`id_producto`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- Volcar la base de datos para la tabla `producto`
--

INSERT INTO `producto` VALUES(1, '06B4491', 'B4491', 176, 'BERNARD', 3, '$100.000', '$ 200.000', 'U.S.A', '2012-02-17', 'A2', 'TOBERA', '');
INSERT INTO `producto` VALUES(2, '06B4391', 'B4391', 13, 'BERNARD', 0, '$400', '$', 'U.S.A.', '2012-02-17', 'A2', 'TOBERA MIG', '');
INSERT INTO `producto` VALUES(3, '06B4492', 'B4492', 213, 'BERNARD', 0, '$30.000', '$', 'U.S.A.', '2012-02-17', 'A2', 'TOBERA MIG', '');
INSERT INTO `producto` VALUES(4, '06B4335', 'B4335', 1, 'BERNARD', 0, '$500', '$', 'U.S.A.', '2012-02-17', 'B2', 'DIFUSORES', '');
INSERT INTO `producto` VALUES(5, '06B4435', '', 197, 'BERNARD', 0, '$00.000', '$', 'U.S.A', '2012-02-17', 'B2', 'DIFUSORES', '');
INSERT INTO `producto` VALUES(6, '06B748935', '', 2, 'BERNARD', 0, '$000', '$', 'U.S.A', '2012-02-17', 'B2', 'BOQUILLA', '');
INSERT INTO `producto` VALUES(7, '06B749640', '', 289, 'BERNARD', 0, '$300', '$', 'U.S.A', '2012-02-17', 'B2', 'BOQUILLA', '');
INSERT INTO `producto` VALUES(8, '06B749645', '', 75, 'BERNARD', 0, '$1000', '$1000', 'U.S.A', '2011-12-31', 'B2', 'BOQUILLA', 'SANTIAGO');
INSERT INTO `producto` VALUES(9, '06B749116', '', 81, 'BERNARD', 0, '$', '$', 'U.S.A', '0000-00-00', 'B2', 'BOQUILLA', 'SANTIAGO');
INSERT INTO `producto` VALUES(10, '06B4786', '', 15, 'BERNARD', 0, '$', '$', 'U.S.A', '0000-00-00', 'C2', 'CUELLOS PISTOLA MIG', 'SANTIAGO');
INSERT INTO `producto` VALUES(11, '06B40923', '', 18, 'BERNARD', 0, '$', '$', 'U.S.A', '0000-00-00', 'C2', 'GATILLOS PISTOLA MIG', 'SANTIAGO');
INSERT INTO `producto` VALUES(12, '06B140623', '', 83, 'BERNARD', 0, '$', '$', 'U.S.A', '0000-00-00', 'C2', 'GOMAS', 'SANTIAGO');
INSERT INTO `producto` VALUES(13, '06TW2362', '', 54, 'TWECO', 0, '$', '$', 'U.S.A', '2012-02-03', 'A3', 'TOBERA', 'ANTOFAGASTA');
INSERT INTO `producto` VALUES(14, '06TW54A', '', 47, 'TWECO', 0, '$', '$', 'U.S.A', '0000-00-00', 'A3', 'DIFUSOR GAS', 'SANTIAGO');
INSERT INTO `producto` VALUES(15, '06TW035', '', 95, 'TWECO', 0, '$', '$', 'U.S.A', '0000-00-00', 'A3', 'PUNTA DE CONTACTO', 'SANTIAGO');
INSERT INTO `producto` VALUES(16, '06TW040', '', 291, 'TWECO', 0, '$', '$', 'U.S.A', '0000-00-00', 'A3', 'PUNTA DE CONTACTO', 'SANTIAGO');
INSERT INTO `producto` VALUES(17, '06TW045', '', 107, 'TWECO', 0, '$', '$', 'U.S.A', '0000-00-00', 'A3', 'PUNTA DE CONTACTO', 'SANTIAGO');
INSERT INTO `producto` VALUES(18, '06TW116', '', 150, 'TWECO', 0, '$', '$', 'U.S.A', '2012-02-17', 'A3', 'PUNTA DE CONTACTO', '');
INSERT INTO `producto` VALUES(19, '06TW64A60', '', 5, 'TWECO', 0, '$', '$', 'U.S.A', '0000-00-00', 'B3', 'TUBO CONDUCTOR', 'SANTIAGO');
INSERT INTO `producto` VALUES(20, '06TW4335', '', 14, 'TWECO', 0, '$', '$', 'U.S.A', '0000-00-00', 'B3', 'ADAPTADOR CABEZAL', 'SANTIAGO');
INSERT INTO `producto` VALUES(21, '06DC11545', '', 550, 'DUROFLEX', 0, '$', '$', 'Portugal', '0000-00-00', 'G2', 'DISCO CORTE METAL', 'SANTIAGO');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `usuario`
--

CREATE TABLE `usuario` (
  `id_usuario` int(11) NOT NULL AUTO_INCREMENT,
  `usuario` varchar(10) NOT NULL,
  `password` varchar(30) NOT NULL,
  PRIMARY KEY (`id_usuario`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=4 ;

--
-- Volcar la base de datos para la tabla `usuario`
--

INSERT INTO `usuario` VALUES(1, 'isidro', 'isidro123');
INSERT INTO `usuario` VALUES(2, 'nayadeth', 'nayadeth123');
INSERT INTO `usuario` VALUES(3, 'admin', 'neurocx');

-- --------------------------------------------------------

--
-- Estructura de tabla para la tabla `vendedor`
--

CREATE TABLE `vendedor` (
  `id_vendedor` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `nombre` varchar(25) NOT NULL,
  `rut` varchar(10) NOT NULL,
  `telefono` varchar(15) NOT NULL,
  `direccion` text NOT NULL,
  PRIMARY KEY (`id_vendedor`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- Volcar la base de datos para la tabla `vendedor`
--

INSERT INTO `vendedor` VALUES(1, 'Oficina', '76.462.540', '7785155', 'Ruiz Tagle #714');
INSERT INTO `vendedor` VALUES(2, 'Carlos', '', '', '');

--
-- Filtros para las tablas descargadas (dump)
--

--
-- Filtros para la tabla `factura`
--
ALTER TABLE `factura`
  ADD CONSTRAINT `factura_ibfk_4` FOREIGN KEY (`id_cliente`) REFERENCES `cliente` (`id_cliente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `factura_ibfk_5` FOREIGN KEY (`id_producto`) REFERENCES `producto` (`id_producto`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `factura_ibfk_6` FOREIGN KEY (`id_vendedor`) REFERENCES `vendedor` (`id_vendedor`) ON DELETE CASCADE ON UPDATE CASCADE;
