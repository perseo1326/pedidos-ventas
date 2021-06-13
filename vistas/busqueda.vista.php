<?php

?>

<div class="ancho-100 padding-05" >
    <h1 class="ancho-100 padding-05 txt-centro txt-big">Búsqueda de Pedido por:</h1>
    <form class="flex-container flex-centrar" action="" method="post">
        <div id="uno" class="flex-container ancho-75 margen-b-05 borde borde-rad-05">
            <div class="flex-container flex-baseline flex-centrar ancho-100 padding-05">
                <!-- NUMERO DE PEDIDO -->
                <label for="numPedido" class="ancho-25 padding-der-05 txt-der">Pedido No.</label>
                <div class="flex-container flex-centrar-vert ancho-50 fondo">
                    <input type="number" name="numPedido" id="numPedido" class="ancho-100 borde borde-rad-05" placeholder_="Pedido #">
                    <i class='fa fa-chevron-circle-right txt-medio' aria-hidden='true' style="margin: -10%  ;"></i>
                </div>
            </div>
            <div class="flex-container flex-baseline flex-centrar ancho-100 padding-05">
                <!-- NOMBRE -->
                <label for="nombre" class="ancho-25 padding-der-05 txt-der">Nombre</label>
                <input type="text" name="nombre" id="nombre" class="ancho-50 borde borde-rad-05" placeholder_="Nombre">
            </div>
        <div class="flex-container flex-baseline flex-centrar ancho-100 padding-05">
                <!-- TOTAL -->
                <label for="total" class="ancho-25 padding-der-05 txt-der">Total</label>
                <input type="text" name="total" id="total" class="ancho-50 borde borde-rad-05" placeholder_="$">
            </div>
            <div class="flex-container flex-baseline flex-centrar ancho-100 padding-05">
                <!-- NUM TELEFONO -->
                <label for="numTelefono" class="ancho-25 padding-der-05 txt-der">No. Teléfono</label>
                <input type="text" name="numTelefono" id="numTelefono" class="ancho-50 borde borde-rad-05" placeholder_="Teléfono">
            </div>
            <div class="flex-container flex-baseline flex-centrar ancho-100 padding-05">
                <!-- FECHA -->
                <label for="fecha" class="ancho-25 padding-der-05 txt-der">Fecha</label>
                <input type="text" name="fecha" id="fecha" class="ancho-50 borde borde-rad-05" placeholder_="Fecha">
            </div>
        </div>
        <div id="dos" class="flex-container ancho-100 centrar-elem margen-b-05">
            <button id="regresar" class="padding-05 ancho-25 txt-medio" type="reset"><span><i class="txt-medio fa fa-undo" aria-hidden="true"></i></span> Regresar</button>
            <button id="buscar" class="padding-05 ancho-25 txt-medio" type="submit"><span><i class="txt-medio fa fa-search" aria-hidden="true"></i></span> Buscar</button>
        </div>
    </form>

    <hr class="">
    
    <div class="flex-container ancho-100">
        <h2 class="margen-b-05 txt-centro txt-big ancho-100">Resultados</h2>
        <div class="flex-container ancho-100">
            <!-- Tabla resumen de pedidos -->
            <div class="ancho-100 borde">
                <table id="busqueda-pedidos" class="ancho-100 margen-b-1">
                    <thead>
                        <tr>
                            <th class="txt-medio">No.</th>
                            <th class="txt-medio">Nombre</th>
                            <th class="txt-medio">Tipo</th>
                            <th class="txt-medio">Pagado</th>
                            <th class="txt-medio">Precio</th>
                            <th class="txt-medio">Telefono</th>
                            <!-- <th>Fecha</th> -->
                            <!-- <th>Hora</th> -->
                            <!-- <th>Detalle</th> -->
                            <th class="txt-medio">Notas</th>
                        </tr>
                    </thead>
                    <tbody id="t-busqueda">
                        <!-- datos de los pedidos -->
                        <?php foreach ($mostrarUltimosPedidos as $key => $pedido) : ?>
                            <tr id='<?php echo $pedido->getNumPedido(); ?>' onclick="javascript:mostrarModal('modalBusqueda')">
                                <td class='txt-medio txt-centro'><?php echo $pedido->getNumPedido(); ?></td>
                                <td class="txt-medio"><?php echo $pedido->getNombre(); ?></td>
                                <td class='txt-medio txt-centro'><?php echo $pedido->getTipoPedido(); ?></td>
                                <td class='txt-medio txt-centro'><?php echo $pedido->getstatusPagado(); ?></td>
                                <td class='txt-medio txt-centro'>$<?php echo $pedido->getTotal();?></td>
                                <td><?php echo $pedido->getTelefono();?></td>
                                <!-- <td><?php echo $pedido->getHora();?></td> -->
                                <!-- <td><?php echo $pedido->getFecha(); ?></td> -->
                                <!-- <td class='txt-centro'><a href='#'><i class='txt-medio fa fa-chevron-circle-right' aria-hidden='true'></i></a></td> -->
                                
                                <?php if ($pedido->hayNotas()) : ?>
                                    <td class='txt-centro'><i class='txt-medio color-a-botones fa fa-exclamation-triangle' aria-hidden='true'></i></td>
                                <?php else : ?>
                                    <td></td>
                                <?php endif ?>
                                
                            </tr>
                        <?php endforeach ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>

</div>

<div class="modal padding-05" id="modalBusqueda">
    <div class="modal-contenido ancho-90 borde borde-rad-05 padding-1 alto-max-100">
        <!-- modal close -->
        <div id="modalClose" class="close-modal">
            <i class="fa fa-times" aria-hidden="true"></i>
        </div>

        <div class="plato ancho-100 margen-b-05">
            <h2 class="txt-centro txt-big">Pedido No. 254</h2>
            <div class="flex-container">
                <div class="flex-container centrar-elem ancho-100">
                    <p class="ancho-100 padding-03 bloque-linea txt-centro txt-medio txt-neg">jose anastacio medina ortiz</p>
                </div>
                <div class="flex-container ancho-100">
                    <p class="ancho-50 bloque-linea txt-der txt-medio padding-03 adding-der-05">Total: </p>
                    <p class="ancho-50 bloque-linea txt-medio txt-neg padding-03">$254</p>
                </div>
                <div class="flex-container centrar-elem ancho-100">
                        <p class="bloque-linea txt-centro txt-medio padding-05 borde borde-rad-05">HABLO </p>
                        <p class="bloque-linea txt-centro txt-medio padding-05 borde borde-rad-05">PAGADO </p>
                </div>
                <div class="flex-container ancho-100">
                    <p class="ancho-50 bloque-linea txt-der txt-medio padding-03 padding-der-05">Telefono</p>
                    <p class="ancho-50 bloque-linea padding-03 txt-medio">9932777878</p>
                </div>
                <div class="flex-container ancho-100">
                    <p class="ancho-100 bloque-linea txt-medio txt-centro">Jue 15 de May 2021 11:25 a.m.</p>
                </div>

            </div>

        </div>
        <div class="plato ancho-100 margen-b-05 scroll-auto_" style="height: 30%; overflow: hidden;">
            <p>Lorem, ipsum dolor sit amet consectetur adipisicing elit. Facilis a molestias et possimus aliquid corrupti corporis quis rerum modi! Laboriosam porro autem nihil dolor similique sit excepturi nemo pariatur! Dolorum tenetur nesciunt facilis quia, hic voluptatum fugit fuga suscipit libero veniam. Quo soluta minus quis saepe aperiam velit, quasi, tempore quaerat alias reiciendis consequatur fuga optio possimus corporis illum eligendi, rem recusandae earum inventore voluptatum odio excepturi tenetur? Assumenda iste iusto et blanditiis velit voluptatibus consectetur perspiciatis asperiores, deleniti minima magnam vero corporis ipsa inventore similique voluptatem exercitationem dignissimos nam ullam doloribus? Id numquam eaque nam alias iste corrupti, distinctio ullam odio veritatis, laudantium excepturi beatae repellendus porro? Est consequuntur id repellendus odit sed unde debitis tempore rerum, recusandae saepe, nam molestias doloribus consequatur obcaecati ad dicta a similique temporibus amet non et perferendis. Distinctio excepturi debitis odio corrupti, nostrum voluptatum iusto magnam cumque ea cum minus delectus atque quas, provident ipsa dolorem, laboriosam vitae non dignissimos perspiciatis consectetur eius repellendus eveniet reprehenderit? Alias amet mollitia at iste, laboriosam expedita nostrum ea facere quos. Aperiam officiis laboriosam unde, esse pariatur saepe, minus mollitia harum in dolorum quibusdam quia magni vero placeat voluptates architecto commodi et tempore omnis voluptatem exercitationem animi officia! Sequi at molestias nesciunt magnam cum enim blanditiis iste exercitationem consequuntur dolorum! Voluptas ab excepturi, quas, commodi illo recusandae esse consequuntur accusamus veritatis ut culpa nisi quidem laborum consequatur modi cum nulla, debitis cumque voluptatem corrupti. A cum assumenda eaque illo id eveniet, provident eos eum quos repudiandae fugiat, architecto impedit aperiam dolorum ipsa, vel atque rerum! Velit placeat eos eaque beatae rem est cumque quasi commodi, eius corporis tenetur accusamus ad voluptatum autem pariatur laboriosam. Odio similique dicta, minima ex ratione voluptatibus dolor delectus fugit repudiandae magni repellat rem id enim harum impedit corrupti quae autem facilis aperiam! Iure, labore? Quibusdam assumenda tempore itaque voluptatum ducimus fuga nostrum quidem temporibus et deserunt ab doloremque odit a quo saepe dolorem laudantium totam cumque repellendus odio, optio nihil unde accusantium? Doloremque, tempora natus porro mollitia aliquid totam rerum ut sapiente veritatis. Nisi, molestiae quasi quidem soluta officia voluptates necessitatibus incidunt rem voluptatum esse nam autem voluptatem provident ab voluptate animi dicta asperiores quibusdam amet quis dolorum nulla? Quam perspiciatis nostrum sunt quaerat minus at, minima amet vel ab ullam unde maxime delectus, sed labore est voluptas facilis. Eveniet possimus culpa rerum facilis, atque cumque molestiae, nostrum id qui quam voluptas, esse dolorum explicabo est et fugit iste velit fugiat eos nesciunt sunt quisquam! Accusamus laudantium non asperiores eveniet enim at nulla labore numquam dignissimos laborum, fuga autem! Explicabo ab odio, quae aspernatur rerum nemo accusantium consequatur molestiae ut minima, dolorum quia iusto veritatis alias temporibus, cumque sequi? Doloribus quisquam, et earum blanditiis architecto porro quod adipisci perferendis quidem tenetur totam? Eos quos, molestiae, eaque officiis facilis similique harum amet blanditiis temporibus explicabo dolor accusantium repellendus obcaecati qui architecto, aut velit odio atque! Commodi debitis eligendi, modi repellat doloremque culpa dicta iure optio error expedita eveniet nam consectetur rem cumque eum tempore, ullam esse, unde tempora dolorem corrupti deserunt quibusdam. Officiis nisi eaque amet? Doloribus harum odit excepturi quod! Et, maxime numquam asperiores ipsam at inventore! Similique sapiente deleniti iure laborum eligendi alias aut dolorem commodi enim ipsam delectus adipisci maiores sed consequuntur repellendus, praesentium dolor exercitationem quam ea, tempora placeat laboriosam corrupti ex? Assumenda voluptatibus repellendus magnam praesentium voluptate beatae veritatis labore in, voluptatum tempora! Doloribus voluptate expedita atque. Est sint reprehenderit accusantium, nostrum molestias, animi maiores fuga perspiciatis aut neque repellendus omnis? Ipsa, sed eligendi ab, officia quis qui maxime dolore illum deserunt magnam ut fugiat facere doloribus! Dolores quam asperiores mollitia delectus temporibus, et nostrum veritatis, error voluptates neque incidunt saepe ratione nobis odit quo quisquam consequatur quas accusamus consequuntur quae maiores ad cumque alias. Accusamus laborum ratione reiciendis ex doloribus quas sint dolorem deleniti velit blanditiis. Necessitatibus voluptate adipisci incidunt tenetur! Aliquid sed quibusdam consequatur aliquam ratione ipsum, ullam nam ipsam obcaecati maxime asperiores mollitia impedit. Quibusdam, sit repudiandae. Impedit exercitationem pariatur provident quas unde quos tempore et voluptates temporibus. Natus veritatis vitae placeat optio culpa enim animi rerum quidem fuga, quod quia modi cum doloribus repudiandae ullam excepturi nisi, consequuntur repellat aliquid cumque labore dolore. Quod praesentium aperiam sit consequuntur soluta fuga assumenda ipsa dignissimos, placeat at totam impedit dolorum, laudantium aut corporis blanditiis sapiente aspernatur. In optio suscipit expedita provident laudantium, hic aperiam incidunt rerum! Libero laudantium repellat officia nulla facilis iure qui quae molestiae at cupiditate atque distinctio vero nisi perferendis itaque modi, debitis quibusdam ratione maiores corporis ipsum odio natus quas! Minus adipisci quae rem nisi laudantium beatae veniam facilis nam odio provident quia, maxime sequi quis sit harum ipsam voluptas ullam omnis voluptates. Culpa placeat incidunt dicta voluptatum reiciendis eos corporis blanditiis repudiandae possimus beatae molestias debitis nemo, alias obcaecati similique adipisci sequi voluptate. Dolores consectetur aliquam temporibus, soluta nam tempore molestiae accusamus voluptatum doloribus sapiente neque! Reprehenderit magnam odio, praesentium nesciunt molestias rerum id sint accusamus, non sed hic ullam at incidunt. Labore nam cupiditate modi delectus ea repellendus culpa mollitia. Soluta assumenda, fuga consectetur voluptate praesentium reprehenderit quos, natus odio quo reiciendis, debitis cum at itaque perspiciatis. Explicabo iure voluptas dolor porro maxime consectetur sapiente perspiciatis illum. Facilis ducimus sapiente consequuntur animi cum fugiat tempore, laboriosam, veritatis cumque laudantium eum ipsam earum eos natus aliquid repellendus saepe. Perferendis minima nobis porro labore nostrum error libero? Ea aliquam doloribus neque a sapiente tempora illum laudantium distinctio eius, itaque consectetur atque, nulla saepe sint! Cumque aliquid, itaque eius enim quas necessitatibus odit eligendi exercitationem illo ut similique voluptates blanditiis, sint maiores, rerum atque corrupti placeat? Voluptate perferendis et quo quisquam possimus cum necessitatibus accusamus dolore earum culpa. Nisi, quam pariatur? Magnam, maxime cumque! Nostrum rem et repellendus accusamus ipsum odio est fugit, incidunt, enim corporis nulla distinctio repellat veniam. Magnam doloribus assumenda obcaecati provident saepe cupiditate sit harum, nemo at iure quia atque facilis eos quaerat illo aliquid? Officia, iste nostrum. Dicta adipisci ullam laudantium atque qui reprehenderit nam ex velit labore distinctio aliquam id nemo officiis, hic excepturi aut quasi delectus praesentium. Iste pariatur error porro itaque consequatur voluptatem vero repudiandae magnam doloribus aut culpa dolor, maiores, consequuntur similique, placeat reprehenderit quibusdam. Beatae dolores sint eaque pariatur optio numquam dolor nesciunt officiis expedita accusantium accusamus obcaecati commodi, exercitationem, ad totam? Consequuntur magni facere atque fugit laudantium minima exercitationem, saepe sit blanditiis id perferendis numquam nihil voluptatibus aliquid dignissimos. Illum aliquid quia nulla provident! Eos aperiam, corporis possimus commodi id facilis debitis repellendus, voluptate quod provident eveniet obcaecati cumque nostrum molestiae vitae assumenda dicta quasi. Qui nesciunt libero laboriosam veniam aut est vitae, voluptatum impedit quo voluptates minima quibusdam omnis placeat sunt totam autem officia sed id. Unde placeat illum saepe animi, perspiciatis, vero fugiat corporis amet voluptatum explicabo obcaecati voluptas neque suscipit quis veritatis repellat natus ea impedit ut aperiam nobis, facilis libero? Dolorem, alias doloremque reiciendis, dignissimos rerum, cumque iste libero nemo natus id praesentium inventore? Ab, iste a doloremque repellendus repellat nobis, fugit soluta hic ipsa distinctio nihil. Aperiam, repellendus qui numquam dolore necessitatibus beatae facilis earum cupiditate quis enim tempora maiores est quae, suscipit corrupti veritatis nostrum officiis repudiandae nam. Dolor delectus placeat laboriosam, quis, quaerat, a sequi enim cumque numquam eum expedita corrupti rem eligendi minima accusantium cum non vero maxime nemo eveniet. Pariatur eum suscipit libero cum illo molestias, odio dignissimos exercitationem nostrum possimus, praesentium maiores ipsam facere ducimus deserunt incidunt asperiores dolores omnis delectus adipisci neque eos eaque aperiam! Distinctio, nobis odit sapiente, dolore, incidunt consequuntur architecto dolores quidem id et aliquam perferendis ipsum eum tempore asperiores sint quaerat nemo rerum accusantium quae illo! Dolorem voluptatum assumenda neque tenetur optio, eaque, at ipsa laborum tempore quos nihil nemo, cumque dolor officiis quod nisi suscipit fugiat! Amet doloremque corporis error eligendi aliquam, unde esse fugiat. Animi magni laudantium eum sint labore ea, asperiores ex, ipsam, sequi reiciendis earum repudiandae minus suscipit porro ducimus. Ratione distinctio non sit temporibus deserunt sequi odio repellendus, exercitationem voluptatem earum, autem animi quia architecto modi dolor veniam itaque. Neque enim cupiditate iusto atque asperiores, modi quibusdam tenetur sunt, nisi ab hic corrupti quam! Iure non cum dicta neque quos ipsa ipsam ullam accusamus, eius quod minima a consequuntur, doloremque nam temporibus sed? Labore cupiditate blanditiis doloremque quam esse culpa a, iusto at iste rem illo, est maiores quidem similique nihil necessitatibus sapiente eveniet suscipit odit sunt maxime repellat! Necessitatibus, sint aspernatur repudiandae libero possimus perspiciatis, nulla voluptate est autem numquam, culpa sit dolores ut voluptates harum vitae temporibus quae? Amet recusandae ducimus perspiciatis repudiandae. Facere temporibus hic tempora odit rerum impedit. Maiores, alias, a quibusdam necessitatibus minima adipisci ea assumenda laudantium facilis, voluptatibus excepturi quia. Corrupti asperiores ipsam temporibus impedit, est saepe ipsa, sequi et modi deserunt quia error ea voluptatem. Assumenda ipsa tempora eligendi quis voluptatem, fugit, fugiat reprehenderit quidem magni officiis eius reiciendis aliquid laboriosam sit totam eos odio voluptate id eaque facere, veritatis numquam quos excepturi? Cum eveniet optio autem adipisci tempore et at dolores, itaque repellendus perspiciatis aut atque reiciendis beatae distinctio, rerum sint est alias, velit facilis! Ut commodi architecto dolor ipsam excepturi suscipit facere veniam, delectus rerum dolores alias voluptates rem numquam earum tenetur provident fuga ipsa aspernatur dolorem pariatur. Qui minus accusamus odit autem fugit mollitia ad iure? Officiis ipsam minima architecto a inventore, non beatae vitae? Aliquam, est. Suscipit vitae maiores officia nisi ducimus veniam! Laboriosam hic, explicabo doloribus accusantium culpa aliquid excepturi, porro veritatis earum non, officia perspiciatis soluta expedita aperiam fugiat placeat exercitationem minima esse ullam animi mollitia nihil! Error odio doloribus aperiam molestiae modi illum dolore placeat, delectus quod, quis fuga rerum, earum beatae. Ex eius totam aliquam. Eligendi modi saepe dignissimos necessitatibus laudantium distinctio, voluptas nemo cumque est ex incidunt quas minus, et, eveniet doloribus! Asperiores magnam perferendis quam, id quos atque ab repellendus nobis culpa provident aperiam beatae earum deleniti dicta ipsa nesciunt quas at inventore sit a aliquam velit eum minus? Iure expedita, fugiat, at maiores architecto dolore quam eum quis voluptatem aliquam beatae saepe voluptates officiis delectus maxime! Explicabo adipisci repellat laudantium, asperiores hic numquam iure qui quia sequi voluptates unde aut, quis earum veniam voluptatem, ab ipsum culpa quaerat consectetur animi! Numquam rem alias qui maiores, voluptatibus asperiores accusantium magni omnis tempora esse eligendi aut doloribus unde dolores fugiat quidem accusamus facilis eaque sit deserunt! Laboriosam voluptatibus nemo accusantium quia quis. Repudiandae aut rem eaque, sed cum in, atque eum maxime nam illum vel quibusdam magni deleniti libero quidem nisi tenetur dignissimos aperiam aliquid incidunt unde. Repellendus recusandae mollitia at asperiores neque qui. Voluptatum, at? Unde beatae consectetur impedit ipsam! Velit quas aperiam dicta magnam veniam modi, recusandae, quia aspernatur ab ipsam sequi in quo! Tenetur explicabo fugit saepe veniam quidem. Saepe totam id deleniti numquam necessitatibus modi quod soluta, dolorem sit ab asperiores nisi natus! Consequuntur, saepe non, necessitatibus aliquid repudiandae corporis animi, numquam laudantium quia tempore quibusdam veniam totam sint repellendus tenetur eveniet. Fugit sit laborum, ipsum dolorum adipisci inventore soluta quisquam suscipit cumque omnis consequatur voluptatum odio fuga, voluptatem itaque quae aliquam doloribus iste optio eveniet sequi! Id iste repudiandae est quos possimus iure debitis, aperiam magni perferendis inventore quibusdam reprehenderit. Mollitia, tempore sed! Consequuntur modi maiores perspiciatis porro ex. Consequatur ducimus natus unde nemo nostrum cumque corporis veritatis, optio vel adipisci asperiores. Eum consectetur natus vero, accusamus laborum sed iure et perspiciatis corrupti soluta minus ipsa excepturi reiciendis modi numquam expedita molestiae tempora nihil neque eius optio? Nisi, voluptatem. Consectetur pariatur facere nisi! Doloremque expedita voluptatibus pariatur beatae atque voluptatum itaque error, ut nihil aperiam quos debitis, assumenda magni quae alias minima reiciendis dolorum hic voluptate. Laboriosam reiciendis, sit perspiciatis at voluptatibus voluptas suscipit deleniti est maxime dolorem! Consectetur numquam dignissimos architecto ducimus voluptatem aliquam, est optio odit inventore laboriosam a magnam aliquid ipsam odio nobis nesciunt, pariatur perferendis molestiae ad sapiente necessitatibus delectus. Sunt odit impedit vero perferendis maiores quasi culpa minima asperiores nam nulla cupiditate totam ducimus amet inventore beatae tempora consequuntur aspernatur exercitationem, quas provident? Eligendi, praesentium dicta!</p>
        </div>
        
        <!-- boton para aceptar la informacion -->
        <div class="flex-container ancho-100 centrar-elem">
            <button id="modalGuardar" class="ancho-33 padding-05 txt-medio">Guardar</button>
            <button id="modalCancelar" class="ancho-33 padding-05 txt-medio">Cancelar</button>
        </div>
    
    </div>
</div>

<script src="../js/busqueda.js"></script>
