<?php 

namespace App\Modules\Base\Database\Seeders;

use DB;
use Illuminate\Database\Seeder;

//modelo(s)
use  App\Modules\Base\Models\Ciudades;


class CiudadesSeeder extends Seeder {

	/**
	 * Run the database seeds.
	 *
	 * @return void
	 */
	public function run()
	{
		$ciudades = [
			[1, 0, 'Maroa'],
			[1, 1, 'Puerto Ayacucho'],
			[1, 0, 'San Fernando de Atabapo'],
			[2, 0, 'Anaco'],
			[2, 0, 'Aragua de Barcelona'],
			[2, 1, 'Barcelona'],
			[2, 0, 'Boca de Uchire'],
			[2, 0, 'Cantaura'],
			[2, 0, 'Clarines'],
			[2, 0, 'El Chaparro'],
			[2, 0, 'El Pao Anzoátegui'],
			[2, 0, 'El Tigre'],
			[2, 0, 'El Tigrito'],
			[2, 0, 'Guanape'],
			[2, 0, 'Guanta'],
			[2, 0, 'Lechería'],
			[2, 0, 'Onoto'],
			[2, 0, 'Pariaguán'],
			[2, 0, 'Píritu'],
			[2, 0, 'Puerto La Cruz'],
			[2, 0, 'Puerto Píritu'],
			[2, 0, 'Sabana de Uchire'],
			[2, 0, 'San Mateo Anzoátegui'],
			[2, 0, 'San Pablo Anzoátegui'],
			[2, 0, 'San Tomé'],
			[2, 0, 'Santa Ana de Anzoátegui'],
			[2, 0, 'Santa Fe Anzoátegui'],
			[2, 0, 'Santa Rosa'],
			[2, 0, 'Soledad'],
			[2, 0, 'Urica'],
			[2, 0, 'Valle de Guanape'],
			[3, 0, 'Achaguas'],
			[3, 0, 'Biruaca'],
			[3, 0, 'Bruzual'],
			[3, 0, 'El Amparo'],
			[3, 0, 'El Nula'],
			[3, 0, 'Elorza'],
			[3, 0, 'Guasdualito'],
			[3, 0, 'Mantecal'],
			[3, 0, 'Puerto Páez'],
			[3, 1, 'San Fernando de Apure'],
			[3, 0, 'San Juan de Payara'],
			[4, 0, 'Barbacoas'],
			[4, 0, 'Cagua'],
			[4, 0, 'Camatagua'],
			[4, 0, 'Choroní'],
			[4, 0, 'Colonia Tovar'],
			[4, 0, 'El Consejo'],
			[4, 0, 'La Victoria'],
			[4, 0, 'Las Tejerías'],
			[4, 0, 'Magdaleno'],
			[4, 1, 'Maracay'],
			[4, 0, 'Ocumare de La Costa'],
			[4, 0, 'Palo Negro'],
			[4, 0, 'San Casimiro'],
			[4, 0, 'San Mateo'],
			[4, 0, 'San Sebastián'],
			[4, 0, 'Santa Cruz de Aragua'],
			[4, 0, 'Tocorón'],
			[4, 0, 'Turmero'],
			[4, 0, 'Villa de Cura'],
			[4, 0, 'Zuata'],
			[5, 1, 'Barinas'],
			[5, 0, 'Barinitas'],
			[5, 0, 'Barrancas'],
			[5, 0, 'Calderas'],
			[5, 0, 'Capitanejo'],
			[5, 0, 'Ciudad Bolivia'],
			[5, 0, 'El Cantón'],
			[5, 0, 'Las Veguitas'],
			[5, 0, 'Libertad de Barinas'],
			[5, 0, 'Sabaneta'],
			[5, 0, 'Santa Bárbara de Barinas'],
			[5, 0, 'Socopó'],
			[6, 0, 'Caicara del Orinoco'],
			[6, 0, 'Canaima'],
			[6, 1, 'Ciudad Bolívar'],
			[6, 0, 'Ciudad Piar'],
			[6, 0, 'El Callao'],
			[6, 0, 'El Dorado'],
			[6, 0, 'El Manteco'],
			[6, 0, 'El Palmar'],
			[6, 0, 'El Pao'],
			[6, 0, 'Guasipati'],
			[6, 0, 'Guri'],
			[6, 0, 'La Paragua'],
			[6, 0, 'Matanzas'],
			[6, 0, 'Puerto Ordaz'],
			[6, 0, 'San Félix'],
			[6, 0, 'Santa Elena de Uairén'],
			[6, 0, 'Tumeremo'],
			[6, 0, 'Unare'],
			[6, 0, 'Upata'],
			[7, 0, 'Bejuma'],
			[7, 0, 'Belén'],
			[7, 0, 'Campo de Carabobo'],
			[7, 0, 'Canoabo'],
			[7, 0, 'Central Tacarigua'],
			[7, 0, 'Chirgua'],
			[7, 0, 'Ciudad Alianza'],
			[7, 0, 'El Palito'],
			[7, 0, 'Guacara'],
			[7, 0, 'Guigue'],
			[7, 0, 'Las Trincheras'],
			[7, 0, 'Los Guayos'],
			[7, 0, 'Mariara'],
			[7, 0, 'Miranda'],
			[7, 0, 'Montalbán'],
			[7, 0, 'Morón'],
			[7, 0, 'Naguanagua'],
			[7, 0, 'Puerto Cabello'],
			[7, 0, 'San Joaquín'],
			[7, 0, 'Tocuyito'],
			[7, 0, 'Urama'],
			[7, 1, 'Valencia'],
			[7, 0, 'Vigirimita'],
			[8, 0, 'Aguirre'],
			[8, 0, 'Apartaderos Cojedes'],
			[8, 0, 'Arismendi'],
			[8, 0, 'Camuriquito'],
			[8, 0, 'El Baúl'],
			[8, 0, 'El Limón'],
			[8, 0, 'El Pao Cojedes'],
			[8, 0, 'El Socorro'],
			[8, 0, 'La Aguadita'],
			[8, 0, 'Las Vegas'],
			[8, 0, 'Libertad de Cojedes'],
			[8, 0, 'Mapuey'],
			[8, 0, 'Piñedo'],
			[8, 0, 'Samancito'],
			[8, 1, 'San Carlos'],
			[8, 0, 'Sucre'],
			[8, 0, 'Tinaco'],
			[8, 0, 'Tinaquillo'],
			[8, 0, 'Vallecito'],
			[9, 1, 'Tucupita'],
			[24, 1, 'Caracas'],
			[24, 0, 'El Junquito'],
			[10, 0, 'Adícora'],
			[10, 0, 'Boca de Aroa'],
			[10, 0, 'Cabure'],
			[10, 0, 'Capadare'],
			[10, 0, 'Capatárida'],
			[10, 0, 'Chichiriviche'],
			[10, 0, 'Churuguara'],
			[10, 1, 'Coro'],
			[10, 0, 'Cumarebo'],
			[10, 0, 'Dabajuro'],
			[10, 0, 'Judibana'],
			[10, 0, 'La Cruz de Taratara'],
			[10, 0, 'La Vela de Coro'],
			[10, 0, 'Los Taques'],
			[10, 0, 'Maparari'],
			[10, 0, 'Mene de Mauroa'],
			[10, 0, 'Mirimire'],
			[10, 0, 'Pedregal'],
			[10, 0, 'Píritu Falcón'],
			[10, 0, 'Pueblo Nuevo Falcón'],
			[10, 0, 'Puerto Cumarebo'],
			[10, 0, 'Punta Cardón'],
			[10, 0, 'Punto Fijo'],
			[10, 0, 'San Juan de Los Cayos'],
			[10, 0, 'San Luis'],
			[10, 0, 'Santa Ana Falcón'],
			[10, 0, 'Santa Cruz De Bucaral'],
			[10, 0, 'Tocopero'],
			[10, 0, 'Tocuyo de La Costa'],
			[10, 0, 'Tucacas'],
			[10, 0, 'Yaracal'],
			[11, 0, 'Altagracia de Orituco'],
			[11, 0, 'Cabruta'],
			[11, 0, 'Calabozo'],
			[11, 0, 'Camaguán'],
			[11, 0, 'Chaguaramas Guárico'],
			[11, 0, 'El Socorro'],
			[11, 0, 'El Sombrero'],
			[11, 0, 'Las Mercedes de Los Llanos'],
			[11, 0, 'Lezama'],
			[11, 0, 'Onoto'],
			[11, 0, 'Ortíz'],
			[11, 0, 'San José de Guaribe'],
			[11, 1, 'San Juan de Los Morros'],
			[11, 0, 'San Rafael de Laya'],
			[11, 0, 'Santa María de Ipire'],
			[11, 0, 'Tucupido'],
			[11, 0, 'Valle de La Pascua'],
			[11, 0, 'Zaraza'],
			[12, 0, 'Aguada Grande'],
			[12, 0, 'Atarigua'],
			[12, 1, 'Barquisimeto'],
			[12, 0, 'Bobare'],
			[12, 0, 'Cabudare'],
			[12, 0, 'Carora'],
			[12, 0, 'Cubiro'],
			[12, 0, 'Cují'],
			[12, 0, 'Duaca'],
			[12, 0, 'El Manzano'],
			[12, 0, 'El Tocuyo'],
			[12, 0, 'Guaríco'],
			[12, 0, 'Humocaro Alto'],
			[12, 0, 'Humocaro Bajo'],
			[12, 0, 'La Miel'],
			[12, 0, 'Moroturo'],
			[12, 0, 'Quíbor'],
			[12, 0, 'Río Claro'],
			[12, 0, 'Sanare'],
			[12, 0, 'Santa Inés'],
			[12, 0, 'Sarare'],
			[12, 0, 'Siquisique'],
			[12, 0, 'Tintorero'],
			[13, 0, 'Apartaderos Mérida'],
			[13, 0, 'Arapuey'],
			[13, 0, 'Bailadores'],
			[13, 0, 'Caja Seca'],
			[13, 0, 'Canaguá'],
			[13, 0, 'Chachopo'],
			[13, 0, 'Chiguara'],
			[13, 0, 'Ejido'],
			[13, 0, 'El Vigía'],
			[13, 0, 'La Azulita'],
			[13, 0, 'La Playa'],
			[13, 0, 'Lagunillas Mérida'],
			[13, 1, 'Mérida'],
			[13, 0, 'Mesa de Bolívar'],
			[13, 0, 'Mucuchíes'],
			[13, 0, 'Mucujepe'],
			[13, 0, 'Mucuruba'],
			[13, 0, 'Nueva Bolivia'],
			[13, 0, 'Palmarito'],
			[13, 0, 'Pueblo Llano'],
			[13, 0, 'Santa Cruz de Mora'],
			[13, 0, 'Santa Elena de Arenales'],
			[13, 0, 'Santo Domingo'],
			[13, 0, 'Tabáy'],
			[13, 0, 'Timotes'],
			[13, 0, 'Torondoy'],
			[13, 0, 'Tovar'],
			[13, 0, 'Tucani'],
			[13, 0, 'Zea'],
			[14, 0, 'Araguita'],
			[14, 0, 'Carrizal'],
			[14, 0, 'Caucagua'],
			[14, 0, 'Chaguaramas Miranda'],
			[14, 0, 'Charallave'],
			[14, 0, 'Chirimena'],
			[14, 0, 'Chuspa'],
			[14, 0, 'Cúa'],
			[14, 0, 'Cupira'],
			[14, 0, 'Curiepe'],
			[14, 0, 'El Guapo'],
			[14, 0, 'El Jarillo'],
			[14, 0, 'Filas de Mariche'],
			[14, 0, 'Guarenas'],
			[14, 0, 'Guatire'],
			[14, 0, 'Higuerote'],
			[14, 0, 'Los Anaucos'],
			[14, 1, 'Los Teques'],
			[14, 0, 'Ocumare del Tuy'],
			[14, 0, 'Panaquire'],
			[14, 0, 'Paracotos'],
			[14, 0, 'Río Chico'],
			[14, 0, 'San Antonio de Los Altos'],
			[14, 0, 'San Diego de Los Altos'],
			[14, 0, 'San Fernando del Guapo'],
			[14, 0, 'San Francisco de Yare'],
			[14, 0, 'San José de Los Altos'],
			[14, 0, 'San José de Río Chico'],
			[14, 0, 'San Pedro de Los Altos'],
			[14, 0, 'Santa Lucía'],
			[14, 0, 'Santa Teresa'],
			[14, 0, 'Tacarigua de La Laguna'],
			[14, 0, 'Tacarigua de Mamporal'],
			[14, 0, 'Tácata'],
			[14, 0, 'Turumo'],
			[15, 0, 'Aguasay'],
			[15, 0, 'Aragua de Maturín'],
			[15, 0, 'Barrancas del Orinoco'],
			[15, 0, 'Caicara de Maturín'],
			[15, 0, 'Caripe'],
			[15, 0, 'Caripito'],
			[15, 0, 'Chaguaramal'],
			[15, 0, 'Chaguaramas Monagas'],
			[15, 0, 'El Furrial'],
			[15, 0, 'El Tejero'],
			[15, 0, 'Jusepín'],
			[15, 0, 'La Toscana'],
			[15, 1, 'Maturín'],
			[15, 0, 'Miraflores'],
			[15, 0, 'Punta de Mata'],
			[15, 0, 'Quiriquire'],
			[15, 0, 'San Antonio de Maturín'],
			[15, 0, 'San Vicente Monagas'],
			[15, 0, 'Santa Bárbara'],
			[15, 0, 'Temblador'],
			[15, 0, 'Teresen'],
			[15, 0, 'Uracoa'],
			[16, 0, 'Altagracia'],
			[16, 0, 'Boca de Pozo'],
			[16, 0, 'Boca de Río'],
			[16, 0, 'El Espinal'],
			[16, 0, 'El Valle del Espíritu Santo'],
			[16, 0, 'El Yaque'],
			[16, 0, 'Juangriego'],
			[16, 1, 'La Asunción'],
			[16, 0, 'La Guardia'],
			[16, 0, 'Pampatar'],
			[16, 0, 'Porlamar'],
			[16, 0, 'Puerto Fermín'],
			[16, 0, 'Punta de Piedras'],
			[16, 0, 'San Francisco de Macanao'],
			[16, 0, 'San Juan Bautista'],
			[16, 0, 'San Pedro de Coche'],
			[16, 0, 'Santa Ana de Nueva Esparta'],
			[16, 0, 'Villa Rosa'],
			[17, 0, 'Acarigua'],
			[17, 0, 'Agua Blanca'],
			[17, 0, 'Araure'],
			[17, 0, 'Biscucuy'],
			[17, 0, 'Boconoito'],
			[17, 0, 'Campo Elías'],
			[17, 0, 'Chabasquén'],
			[17, 1, 'Guanare'],
			[17, 0, 'Guanarito'],
			[17, 0, 'La Aparición'],
			[17, 0, 'La Misión'],
			[17, 0, 'Mesa de Cavacas'],
			[17, 0, 'Ospino'],
			[17, 0, 'Papelón'],
			[17, 0, 'Payara'],
			[17, 0, 'Pimpinela'],
			[17, 0, 'Píritu de Portuguesa'],
			[17, 0, 'San Rafael de Onoto'],
			[17, 0, 'Santa Rosalía'],
			[17, 0, 'Turén'],
			[18, 0, 'Altos de Sucre'],
			[18, 0, 'Araya'],
			[18, 0, 'Cariaco'],
			[18, 0, 'Carúpano'],
			[18, 0, 'Casanay'],
			[18, 1, 'Cumaná'],
			[18, 0, 'Cumanacoa'],
			[18, 0, 'El Morro Puerto Santo'],
			[18, 0, 'El Pilar'],
			[18, 0, 'El Poblado'],
			[18, 0, 'Guaca'],
			[18, 0, 'Guiria'],
			[18, 0, 'Irapa'],
			[18, 0, 'Manicuare'],
			[18, 0, 'Mariguitar'],
			[18, 0, 'Río Caribe'],
			[18, 0, 'San Antonio del Golfo'],
			[18, 0, 'San José de Aerocuar'],
			[18, 0, 'San Vicente de Sucre'],
			[18, 0, 'Santa Fe de Sucre'],
			[18, 0, 'Tunapuy'],
			[18, 0, 'Yaguaraparo'],
			[18, 0, 'Yoco'],
			[19, 0, 'Abejales'],
			[19, 0, 'Borota'],
			[19, 0, 'Bramon'],
			[19, 0, 'Capacho'],
			[19, 0, 'Colón'],
			[19, 0, 'Coloncito'],
			[19, 0, 'Cordero'],
			[19, 0, 'El Cobre'],
			[19, 0, 'El Pinal'],
			[19, 0, 'Independencia'],
			[19, 0, 'La Fría'],
			[19, 0, 'La Grita'],
			[19, 0, 'La Pedrera'],
			[19, 0, 'La Tendida'],
			[19, 0, 'Las Delicias'],
			[19, 0, 'Las Hernández'],
			[19, 0, 'Lobatera'],
			[19, 0, 'Michelena'],
			[19, 0, 'Palmira'],
			[19, 0, 'Pregonero'],
			[19, 0, 'Queniquea'],
			[19, 0, 'Rubio'],
			[19, 0, 'San Antonio del Tachira'],
			[19, 1, 'San Cristobal'],
			[19, 0, 'San José de Bolívar'],
			[19, 0, 'San Josecito'],
			[19, 0, 'San Pedro del Río'],
			[19, 0, 'Santa Ana Táchira'],
			[19, 0, 'Seboruco'],
			[19, 0, 'Táriba'],
			[19, 0, 'Umuquena'],
			[19, 0, 'Ureña'],
			[20, 0, 'Batatal'],
			[20, 0, 'Betijoque'],
			[20, 0, 'Boconó'],
			[20, 0, 'Carache'],
			[20, 0, 'Chejende'],
			[20, 0, 'Cuicas'],
			[20, 0, 'El Dividive'],
			[20, 0, 'El Jaguito'],
			[20, 0, 'Escuque'],
			[20, 0, 'Isnotú'],
			[20, 0, 'Jajó'],
			[20, 0, 'La Ceiba'],
			[20, 0, 'La Concepción de Trujllo'],
			[20, 0, 'La Mesa de Esnujaque'],
			[20, 0, 'La Puerta'],
			[20, 0, 'La Quebrada'],
			[20, 0, 'Mendoza Fría'],
			[20, 0, 'Meseta de Chimpire'],
			[20, 0, 'Monay'],
			[20, 0, 'Motatán'],
			[20, 0, 'Pampán'],
			[20, 0, 'Pampanito'],
			[20, 0, 'Sabana de Mendoza'],
			[20, 0, 'San Lázaro'],
			[20, 0, 'Santa Ana de Trujillo'],
			[20, 0, 'Tostós'],
			[20, 1, 'Trujillo'],
			[20, 0, 'Valera'],
			[21, 0, 'Carayaca'],
			[21, 0, 'Litoral'],
			[25, 0, 'Archipiélago Los Roques'],
			[22, 0, 'Aroa'],
			[22, 0, 'Boraure'],
			[22, 0, 'Campo Elías de Yaracuy'],
			[22, 0, 'Chivacoa'],
			[22, 0, 'Cocorote'],
			[22, 0, 'Farriar'],
			[22, 0, 'Guama'],
			[22, 0, 'Marín'],
			[22, 0, 'Nirgua'],
			[22, 0, 'Sabana de Parra'],
			[22, 0, 'Salom'],
			[22, 1, 'San Felipe'],
			[22, 0, 'San Pablo de Yaracuy'],
			[22, 0, 'Urachiche'],
			[22, 0, 'Yaritagua'],
			[22, 0, 'Yumare'],
			[23, 0, 'Bachaquero'],
			[23, 0, 'Bobures'],
			[23, 0, 'Cabimas'],
			[23, 0, 'Campo Concepción'],
			[23, 0, 'Campo Mara'],
			[23, 0, 'Campo Rojo'],
			[23, 0, 'Carrasquero'],
			[23, 0, 'Casigua'],
			[23, 0, 'Chiquinquirá'],
			[23, 0, 'Ciudad Ojeda'],
			[23, 0, 'El Batey'],
			[23, 0, 'El Carmelo'],
			[23, 0, 'El Chivo'],
			[23, 0, 'El Guayabo'],
			[23, 0, 'El Mene'],
			[23, 0, 'El Venado'],
			[23, 0, 'Encontrados'],
			[23, 0, 'Gibraltar'],
			[23, 0, 'Isla de Toas'],
			[23, 0, 'La Concepción del Zulia'],
			[23, 0, 'La Paz'],
			[23, 0, 'La Sierrita'],
			[23, 0, 'Lagunillas del Zulia'],
			[23, 0, 'Las Piedras de Perijá'],
			[23, 0, 'Los Cortijos'],
			[23, 0, 'Machiques'],
			[23, 1, 'Maracaibo'],
			[23, 0, 'Mene Grande'],
			[23, 0, 'Palmarejo'],
			[23, 0, 'Paraguaipoa'],
			[23, 0, 'Potrerito'],
			[23, 0, 'Pueblo Nuevo del Zulia'],
			[23, 0, 'Puertos de Altagracia'],
			[23, 0, 'Punta Gorda'],
			[23, 0, 'Sabaneta de Palma'],
			[23, 0, 'San Francisco'],
			[23, 0, 'San José de Perijá'],
			[23, 0, 'San Rafael del Moján'],
			[23, 0, 'San Timoteo'],
			[23, 0, 'Santa Bárbara Del Zulia'],
			[23, 0, 'Santa Cruz de Mara'],
			[23, 0, 'Santa Cruz del Zulia'],
			[23, 0, 'Santa Rita'],
			[23, 0, 'Sinamaica'],
			[23, 0, 'Tamare'],
			[23, 0, 'Tía Juana'],
			[23, 0, 'Villa del Rosario'],
			[21, 1, 'La Guaira'],
			[21, 0, 'Catia La Mar'],
			[21, 0, 'Macuto'],
			[21, 0, 'Naiguatá'],
			[25, 0, 'Archipiélago Los Monjes'],
			[25, 0, 'Isla La Tortuga y Cayos adyacentes'],
			[25, 0, 'Isla La Sola'],
			[25, 0, 'Islas Los Testigos'],
			[25, 0, 'Islas Los Frailes'],
			[25, 0, 'Isla La Orchila'],
			[25, 0, 'Archipiélago Las Aves'],
			[25, 0, 'Isla de Aves'],
			[25, 0, 'Isla La Blanquilla'],
			[25, 0, 'Isla de Patos'],
			[25, 0, 'Islas Los Hermanos']
		];

		DB::beginTransaction();
		try{
			foreach ($ciudades as $ciudad) {
				Ciudades::create([
					'estados_id' => $ciudad[0],
					'capital' => $ciudad[1],
					'nombre' => $ciudad[2]
				]);
			}
		}catch(Exception $e){
			DB::rollback();
			echo "Error ";
		}
		DB::commit();
	}
}