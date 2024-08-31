<?php
    include "../../../components/database.php";

    session_start();

    if (!isset($_SESSION['correo']) || $_SESSION['tipo_usuario'] != 1) {
        header('Location: ../../../signin.php');
        exit();
    } else {
        $correo = $_SESSION['correo'];

        $query = "SELECT nombres, apellidos FROM usuario WHERE correo = '$correo';";
        $result = mysqli_query($connection, $query);

        while ($row = mysqli_fetch_assoc($result)) {
            $nombres = explode(" ", $row["nombres"]);
            $apellidos = explode(" ", $row["apellidos"]);

            $nombre = $nombres[0];
            $apellido = $apellidos[0];
        }
    }
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Nueva inspección pre-arribo</title>
    <link rel="stylesheet" href="../../../assets/css/forms/pre-arrival-inspection/new-form.css">
    <link rel="icon" href="../../../assets/img/favicon.ico">
</head>

<body>
    <?php include_once "../components/pre_arrival_inspection_menu.php"; ?>

    <div class="content" id="content">
        <h1>Inspección Pre-Arribo</h1>

        <?php if ($_GET) { ?>
        <p class="error-text">
            <span class="error">
                Error al enviar los datos: <?php include_once "../../../components/messages/error_messages.php"; ?>
            </span>
        </p>
        <?php } ?>

        <form id="form" class="form" action="form_sending.php" method="POST">
            <p class="form-sentence">Por favor, ingrese los siguientes datos:</p>

            <div class="details">
                <div class="detail">
                    <label for="buque">Buque:</label>
                    <input type="text" id="buque" name="buque" required>
                </div>
                <div class="detail">
                    <label for="lugar">Lugar:</label>
                    <input type="text" id="lugar" name="lugar" value="Pisco - Perú" required readonly>
                </div>
                <div class="detail">
                    <label for="terminal">Terminal:</label>
                    <input type="text" id="terminal" name="terminal" value="Pisco Camisea Marine Terminal" required readonly>
                </div>
                <div class="detail">
                    <label for="operacion">Operación:</label>
                    <input type="text" id="operacion" name="operacion" required>
                </div>
                <div class="detail">
                    <label for="prod_transferir">Producto por transferir:</label>
                    <input type="text" id="prod_transferir" name="prod_transferir" required>
                </div>
                <div class="detail">
                    <label for="fecha_hora_inicio">Fecha y hora de inicio:</label>
                    <input type="datetime-local" id="fecha_hora_inicio" name="fecha_hora_inicio" min="2000-01-01T00:00"
                        required>
                </div>
                <div class="detail">
                    <label for="operacion">Número de operación:</label>
                    <input type="number" id="id_buque" name="id_buque">
                </div>
            </div>

            <div class="tables">
                <h2>Parte I - Certificado de equipos</h2>
                <div class="table-container">
                    <table class="form-table">
                        <tr>
                            <th colspan="2">Detalle de Inspección</th>
                            <th class="date">Fecha</th>
                            <th class="conf">Sí</th>
                            <th class="conf">No</th>
                            <th class="conf">N/A</th>
                            <th>Observación</th>
                        </tr>
                        <tr class="information">
                            <th>1</th>
                            <td>Last calibration certificate of fixed gas detector / Certificado de la última calibración
                                del detector fijo de gases</td>

                            <td>
                                <select>
                                    <option selected disabled>Seleccione...</option>
                                    <option>Fecha de expiración</option>
                                    <option>Ninguna</option>
                                </select>

                                <input type="hidden" name="exp1">
                            </td>

                            <td><input type="radio" name="con1" value="si" required></td>
                            <td><input type="radio" name="con1" value="no"></td>
                            <td><input type="radio" name="con1" value="na"></td>
                            <td><textarea name="obs1"></textarea></td>
                        </tr>
                        <tr class="information">
                            <th>2</th>
                            <td>Last calibration certificate of UTI equipment / Último certificado de calibración del equipo
                                UTI</td>

                            <td>
                                <select>
                                    <option selected disabled>Seleccione...</option>
                                    <option>Fecha de expiración</option>
                                    <option>Ninguna</option>
                                </select>

                                <input type="hidden" name="exp2">
                            </td>

                            <td><input type="radio" name="con2" value="si" required></td>
                            <td><input type="radio" name="con2" value="no"></td>
                            <td><input type="radio" name="con2" value="na"></td>
                            <td><textarea name="obs2"></textarea></td>
                        </tr>
                        <tr class="information">
                            <th>3</th>
                            <td>Last calibration certificate of oxygen measurement equipment / Último certificado de
                                calibración del equipo medidor de oxígeno</td>

                            <td>
                                <select>
                                    <option selected disabled>Seleccione...</option>
                                    <option>Fecha de expiración</option>
                                    <option>Ninguna</option>
                                </select>

                                <input type="hidden" name="exp3">
                            </td>

                            <td><input type="radio" name="con3" value="si" required></td>
                            <td><input type="radio" name="con3" value="no"></td>
                            <td><input type="radio" name="con3" value="na"></td>
                            <td><textarea name="obs3"></textarea></td>
                        </tr>
                        <tr class="information">
                            <th>4</th>
                            <td>Cargo tanks cleaning certificate / Certificado de limpieza de tanques de carga</td>

                            <td>
                                <select>
                                    <option selected disabled>Seleccione...</option>
                                    <option>Fecha de expiración</option>
                                    <option>Ninguna</option>
                                </select>

                                <input type="hidden" name="exp4">
                            </td>

                            <td><input type="radio" name="con4" value="si" required></td>
                            <td><input type="radio" name="con4" value="no"></td>
                            <td><input type="radio" name="con4" value="na"></td>
                            <td><textarea name="obs4"></textarea></td>
                        </tr>
                        <tr class="information">
                            <th>5</th>
                            <td>Brake holding capacity and rendering test certificate / Certificado de prueba de capacidad y
                                rendimiento de los frenos de los winches</td>

                            <td>
                                <select>
                                    <option selected disabled>Seleccione...</option>
                                    <option>Fecha de expiración</option>
                                    <option>Ninguna</option>
                                </select>

                                <input type="hidden" name="exp5">
                            </td>

                            <td><input type="radio" name="con5" value="si" required></td>
                            <td><input type="radio" name="con5" value="no"></td>
                            <td><input type="radio" name="con5" value="na"></td>
                            <td><textarea name="obs5"></textarea></td>
                        </tr>
                        <tr class="information">
                            <th>6</th>
                            <td>Certificates of all mooring ropes and tails / Certificados de líneas de amarre y colas</td>

                            <td>
                                <select>
                                    <option selected disabled>Seleccione...</option>
                                    <option>Fecha de expiración</option>
                                    <option>Ninguna</option>
                                </select>

                                <input type="hidden" name="exp6">
                            </td>

                            <td><input type="radio" name="con6" value="si" required></td>
                            <td><input type="radio" name="con6" value="no"></td>
                            <td><input type="radio" name="con6" value="na"></td>
                            <td><textarea name="obs6"></textarea></td>
                        </tr>
                        <tr class="information">
                            <th>7</th>
                            <td>Records of inspection or maintenance of mooring ropes and mooring equipment / Registros de
                                inspección o mantenimiento de los cabos y equipos de amarre</td>

                            <td>
                                <select>
                                    <option selected disabled>Seleccione...</option>
                                    <option>Fecha de expiración</option>
                                    <option>Ninguna</option>
                                </select>

                                <input type="hidden" name="exp7">
                            </td>

                            <td><input type="radio" name="con7" value="si" required></td>
                            <td><input type="radio" name="con7" value="no"></td>
                            <td><input type="radio" name="con7" value="na"></td>
                            <td><textarea name="obs7"></textarea></td>
                        </tr>
                        <tr class="information">
                            <th>8</th>
                            <td>Records of the last test and/or calibration of the safety valves of the cargo tanks /
                                Registro de la última prueba y/o calibración de las válvulas de seguridad de los tanques de
                                carga</td>

                            <td>
                                <select>
                                    <option selected disabled>Seleccione...</option>
                                    <option>Fecha de expiración</option>
                                    <option>Ninguna</option>
                                </select>

                                <input type="hidden" name="exp8">
                            </td>

                            <td><input type="radio" name="con8" value="si" required></td>
                            <td><input type="radio" name="con8" value="no"></td>
                            <td><input type="radio" name="con8" value="na"></td>
                            <td><textarea name="obs8"></textarea></td>
                        </tr>
                        <tr class="information">
                            <th>9</th>
                            <td>Last test of load certificate of crane / Certificado de última prueba de carga de la grúa
                            </td>

                            <td>
                                <select>
                                    <option selected disabled>Seleccione...</option>
                                    <option>Fecha de expiración</option>
                                    <option>Ninguna</option>
                                </select>

                                <input type="hidden" name="exp9">
                            </td>

                            <td><input type="radio" name="con9" value="si" required></td>
                            <td><input type="radio" name="con9" value="no"></td>
                            <td><input type="radio" name="con9" value="na"></td>
                            <td><textarea name="obs9"></textarea></td>
                        </tr>
                        <tr class="information">
                            <th>10</th>
                            <td>Record or evidence of last tests performed on cargo system's equipment and alarms (ESD, HiHi,
                                etc). / Registro o evidencia de las últimas pruebas realizadas a sus equipos y alarmas de carga
                                (ESD, HiHi, etc).</td>

                            <td>
                                <select>
                                    <option selected disabled>Seleccione...</option>
                                    <option>Fecha de expiración</option>
                                    <option>Ninguna</option>
                                </select>

                                <input type="hidden" name="exp10">
                            </td>

                            <td><input type="radio" name="con10" value="si" required></td>
                            <td><input type="radio" name="con10" value="no"></td>
                            <td><input type="radio" name="con10" value="na"></td>
                            <td><textarea name="obs10"></textarea></td>
                        </tr>
                    </table>
                </div>

                <h2>Parte II - Inspección de equipos en cubierta</h2>
                <div class="table-container">
                    <table class="form-table">
                        <tr>
                            <th colspan="2">Detalle de Inspección</th>
                            <th class="conf">Sí</th>
                            <th class="conf">No</th>
                            <th class="conf">N/A</th>
                            <th>Observación</th>
                        </tr>
                        <tr class="information">
                            <th>1</th>
                            <td>The mooring lines are adequate for conditions at terminal / Las líneas de amarre son
                                adecuadas para las condiciones en el Terminal</td>

                            <td><input type="radio" name="con11" value="si" required></td>
                            <td><input type="radio" name="con11" value="no"></td>
                            <td><input type="radio" name="con11" value="na"></td>
                            <td><textarea name="obs11"></textarea></td>
                        </tr>
                        <tr class="information">
                            <th>2</th>
                            <td>The mooring winches are adequate and fully operative / Los winches de amarre están
                                completamente operativos</td>

                            <td><input type="radio" name="con12" value="si" required></td>
                            <td><input type="radio" name="con12" value="no"></td>
                            <td><input type="radio" name="con12" value="na"></td>
                            <td><textarea name="obs12"></textarea></td>
                        </tr>
                        <tr class="information">
                            <th>3</th>
                            <td>The overboard or sea valves are sealed or lashed in closed position, Annex I & II / Las
                                válvulas de fuera de borda o de mar están selladas y aseguradas en posición de cierre, anexo
                                I y II</td>

                            <td><input type="radio" name="con13" value="si" required></td>
                            <td><input type="radio" name="con13" value="no"></td>
                            <td><input type="radio" name="con13" value="na"></td>
                            <td><textarea name="obs13"></textarea></td>
                        </tr>
                        <tr class="information">
                            <th>4</th>
                            <td>High level and overfill alarms of all cargo tanks were tested and operating properly / Las
                                alarmas de alto nivel y sobrellenado de los tanques de carga del buque fueron probadas y
                                operan adecuadamente.</td>


                            <td><input type="radio" name="con14" value="si" required></td>
                            <td><input type="radio" name="con14" value="no"></td>
                            <td><input type="radio" name="con14" value="na"></td>
                            <td><textarea name="obs14"></textarea></td>
                        </tr>
                        <tr class="information">
                            <th>5</th>
                            <td>The automatic shutdown system of the vessel has been tested and found to be operating
                                properly / El sistema de parada automático del buque ha sido probada y se encuentra operando
                                apropiadamente</td>


                            <td><input type="radio" name="con15" value="si" required></td>
                            <td><input type="radio" name="con15" value="no"></td>
                            <td><input type="radio" name="con15" value="na"></td>
                            <td><textarea name="obs15"></textarea></td>
                        </tr>
                        <tr class="information">
                            <th>6</th>
                            <td>Are the vessel's tanks inerted? / ¿Están los tanques del buque inertizados?</td>

                            <td><input type="radio" name="con16" value="si" required></td>
                            <td><input type="radio" name="con16" value="no"></td>
                            <td><input type="radio" name="con16" value="na"></td>
                            <td><textarea name="obs16"></textarea></td>
                        </tr>
                        <tr class="information">
                            <th>7</th>
                            <td>The inert gas system or N2 supply on board is operative and work without any observation
                                (discharging operations only)? / ¿El sistema de gas inerte o abastecimiento de N2 a bordo se
                                encuentra operativo y trabaja sin observaciones (solo para operaciones de descarga)?</td>

                            <td><input type="radio" name="con17" value="si" required></td>
                            <td><input type="radio" name="con17" value="no"></td>
                            <td><input type="radio" name="con17" value="na"></td>
                            <td><textarea name="obs17"></textarea></td>
                        </tr>
                        <tr class="information">
                            <th>8</th>
                            <td>Vapor pressure inside cargo tanks is appropriate for loading operations (recommendable less
                                than 40 mbar for loading operations only)? / ¿La presión de vapor en los tanques de carga es
                                la adecuada para las operaciones de carga (recomendable menor a 40 mbar solo para
                                operaciones de carga)?</td>

                            <td><input type="radio" name="con18" value="si" required></td>
                            <td><input type="radio" name="con18" value="no"></td>
                            <td><input type="radio" name="con18" value="na"></td>
                            <td><textarea name="obs18"></textarea></td>
                        </tr>
                        <tr class="information">
                            <th>9</th>
                            <td>The firefighting system is fully operative and tested / El sistema contra incendio está
                                completamente probado y operativo.</td>

                            <td><input type="radio" name="con19" value="si" required></td>
                            <td><input type="radio" name="con19" value="no"></td>
                            <td><input type="radio" name="con19" value="na"></td>
                            <td><textarea name="obs19"></textarea></td>
                        </tr>
                        <tr class="information">
                            <th>10</th>
                            <td>The vessel has adequate coupling or reducer to connect the terminal loading arm, vapor
                                recovery line and hoses flanges / El buque cuenta con las reducciones para la conexión de
                                los brazos, línea de vapores y manguera de carga</td>

                            <td><input type="radio" name="con20" value="si" required></td>
                            <td><input type="radio" name="con20" value="no"></td>
                            <td><input type="radio" name="con20" value="na"></td>
                            <td><textarea name="obs20"></textarea></td>
                        </tr>
                        <tr class="information">
                            <th>11</th>
                            <td>Oily water separator overboard valve sealed / La válvula de descarga fuera de borda del
                                separador de aguas oleosas, ¿está sellada?</td>

                            <td><input type="radio" name="con21" value="si" required></td>
                            <td><input type="radio" name="con21" value="no"></td>
                            <td><input type="radio" name="con21" value="na"></td>
                            <td><textarea name="obs21"></textarea></td>
                        </tr>
                        <tr class="information">
                            <th>12</th>
                            <td>Sewage plant overboard valve locked sealed / La válvula de descarga fuera de borda de planta
                                de tratamiento de aguas servidas, ¿está sellada?</td>

                            <td><input type="radio" name="con22" value="si" required></td>
                            <td><input type="radio" name="con22" value="no"></td>
                            <td><input type="radio" name="con22" value="na"></td>
                            <td><textarea name="obs22"></textarea></td>
                        </tr>
                        <tr class="information">
                            <th>13</th>
                            <td>Pilot confirmed bridge vessel equipment have been fully tested, ready for maneuvering and
                                signed the Pilot Card satisfactorily / El Práctico confirma que los equipos del puente de
                                comando han sido probados, están listos para la maniobra y ha firmado la Cartilla de
                                Práctico satisfactoriamente</td>

                            <td><input type="radio" name="con23" value="si" required></td>
                            <td><input type="radio" name="con23" value="no"></td>
                            <td><input type="radio" name="con23" value="na"></td>
                            <td><textarea name="obs23"></textarea></td>
                        </tr>
                        <tr class="information">
                            <th>14</th>
                            <td>Mooring tails are fitted to mooring lines, are they correctly fitted? / ¿Las colas de amarre
                                están sujetas de forma correcta a las líneas de amarre?</td>

                            <td><input type="radio" name="con24" value="si" required></td>
                            <td><input type="radio" name="con24" value="no"></td>
                            <td><input type="radio" name="con24" value="na"></td>
                            <td><textarea name="obs24"></textarea></td>
                        </tr>
                        <tr class="information">
                            <th>15</th>
                            <td>The fixed gas detector alarms were tested and operating properly / Las alarmas del equipo
                                detector de gases fijo del buque fueron probadas y operan adecuadamente</td>

                            <td><input type="radio" name="con25" value="si" required></td>
                            <td><input type="radio" name="con25" value="no"></td>
                            <td><input type="radio" name="con25" value="na"></td>
                            <td><textarea name="obs25"></textarea></td>
                        </tr>
                        <tr class="information">
                            <th>16</th>
                            <td>The electric motor room air lock alarms were tested and operating properly / Las alarmas del
                                Air Lock del cuarto de motores eléctricos fueron probadas y operan correctamente</td>

                            <td><input type="radio" name="con26" value="si" required></td>
                            <td><input type="radio" name="con26" value="no"></td>
                            <td><input type="radio" name="con26" value="na"></td>
                            <td><textarea name="obs26"></textarea></td>
                        </tr>
                        <tr class="information">
                            <th>17</th>
                            <td>The safety relief or P/V valves are properly marked / Las válvulas de seguridad
                                o presión y vacío están correctamente marcadas</td>

                            <td><input type="radio" name="con27" value="si" required></td>
                            <td><input type="radio" name="con27" value="no"></td>
                            <td><input type="radio" name="con27" value="na"></td>
                            <td><textarea name="obs27"></textarea></td>
                        </tr>
                        <tr class="information">
                            <th>18</th>
                            <td>The deck spray system was tested and operating properly / El sistema de rociadores de
                                cubierta fue probado y opera correctamente</td>

                            <td><input type="radio" name="con28" value="si" required></td>
                            <td><input type="radio" name="con28" value="no"></td>
                            <td><input type="radio" name="con28" value="na"></td>
                            <td><textarea name="obs28"></textarea></td>
                        </tr>
                        <tr class="information">
                            <th>19</th>
                            <td>Loading Master informed to the Captain and Pilot the terminal's sign posting condition and
                                the weather conditions for maneuvers / El Loading Master informó al Capitán y Práctico, la
                                condición de la señalización del terminal y sobre las condiciones oceanográficas para la
                                maniobra</td>

                            <td><input type="radio" name="con29" value="si" required></td>
                            <td><input type="radio" name="con29" value="no"></td>
                            <td><input type="radio" name="con29" value="na"></td>
                            <td><textarea name="obs29"></textarea></td>
                        </tr>
                        <tr class="information">
                            <th>20</th>
                            <td>Navigation charts/ECDIS used to access the TMPC are in force /
                                Las cartas de navegación/ECDIS utilizadas para acceder al TMPC se encuentran vigentes.
                            </td>

                            <td><input type="radio" name="con30" value="si" required></td>
                            <td><input type="radio" name="con30" value="no"></td>
                            <td><input type="radio" name="con30" value="na"></td>
                            <td><textarea name="obs30"></textarea></td>
                        </tr>
                        <tr class="information">
                            <th>21</th>
                            <td>Mooring plan has been checked and duly agreed by the Loading Master, Captain and Pilot / El
                                plan de amarre ha sido revisado y debidamente acordado por el Loading Master, Capitán y
                                Práctico Marítimo.</td>

                            <td><input type="radio" name="con31" value="si" required></td>
                            <td><input type="radio" name="con31" value="no"></td>
                            <td><input type="radio" name="con31" value="na"></td>
                            <td><textarea name="obs31"></textarea></td>
                        </tr>
                    </table>
                </div>
            </div>

            <div class="disclaimer">
                <p class="bold">THE UNDERSIGNED ATTEST THAT WE MADE A JOINT INSPECTION OF THE VESSEL WITH REFERENCE TO
                    THE ABOVE REQUIREMENTS AND IN FRONT OF THE EACH ONE OF THEM WE INDICATED THAT THE REGULATIONS HAVE
                    BEEN COMPLIED.</p>
                <p class="italic">Los firmantes dan fe de que se realizó una inspección conjunta al buque con referencia
                    a los puntos anteriores y frente a cada uno de ellos, hemos indicado que el reglamento ha sido
                    cumplido.</p>
            </div>

            <div class="signatures">
                <div class="sign-author">
                    <div class="sign-data">
                        <div class="sign-text">
                            <p class="bold">FOR VESSEL (SIGNATURE) /</p>
                            <p class="italic">Por el buque (firma)</p>
                        </div>
                        <input type="text" name="firma_buque" disabled>
                    </div>
                    <div class="sign-data">
                        <div class="sign-text">
                            <p>
                                <span class="bold">TITLE / </span><span class="italic">Grado:</span>
                            </p>
                        </div>
                        <input type="text" name="grado_buque">
                    </div>
                    <div class="sign-data">
                        <div class="sign-text">
                            <p class="bold">COMPLETED DATE & TIME:</p>
                            <p class="italic">Fecha y hora de término:</p>
                        </div>
                        <input type="datetime-local" name="fecha_hora_buque" min="2000-01-01T00:00">
                    </div>
                </div>
                <div class="sign-author">
                    <div class="sign-data">
                        <div class="sign-text">
                            <p class="bold">FOR TERMINAL (SIGNATURE) /</p>
                            <p class="italic">Por el terminal (firma)</p>
                        </div>
                        <input type="text" name="firma_terminal" disabled>
                    </div>
                    <div class="sign-data">
                        <div class="sign-text">
                            <p>
                                <span class="bold">TITLE / </span><span class="italic">Grado:</span>
                            </p>
                        </div>
                        <input type="text" name="grado_terminal" value="Loading Master" readonly>
                    </div>
                    <div class="sign-data">
                        <div class="sign-text">
                            <p class="bold">COMPLETED DATE & TIME:</p>
                            <p class="italic">Fecha y hora de término:</p>
                        </div>
                        <input type="datetime-local" name="fecha_hora_terminal" min="2000-01-01T00:00">
                    </div>
                </div>
            </div>

            <div class="options">
                <input type="button" class="return" onclick="clearFormData()" value="Limpiar formulario">
                <input type="button" id="guardar-boton" class="submit" value="Guardar y cerrar operación">
            </div>

            <div id="verificacion">
                <h1>Cierre de Inspección Pre-Arribo</h1>
                <p>
                    ¿Está seguro de que desea cerrar esta operación? No podrán agregarse ni editarse nuevos parámetros.
                    <!-- Si está seguro, ingrese su contraseña para continuar: -->
                </p>

                <!-- <div class="verification-password">
                    <input type="password" name="password">
                </div> -->

                <div class="verification-buttons">
                    <input type="button" id="ocultarVerificacion" class="return" value="Cancelar">
                    <input type="submit" name="continuar" class="submit" value="Continuar">
                </div>
            </div>
        </form>
    </div>

    <script src="../../../assets/js/general.js"></script>
    <script src="../../../assets/js/localstorage/pre-arrival-inspection.js"></script>
    <script src="../../../assets/js/forms/pre-arrival-inspection.js"></script>
</body>

</html>