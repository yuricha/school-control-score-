<?php

class Status_ProjectDinamic {

    //Para Dinamcias y Proyectos
	const PENDIENTE = 0;//Cuando ingresa un nuevo Proyecto o Dinamcia
	const ACTIVO = 1; //Cuando se lanza el proyecto pasa a estado activo junto con sus Dinamicas respectivas
	const CERRADO = 2; //Cuando una Dinamica pasa a estado cerrado, cuando terminan todas las dinamcias del Proyecto reclutamiento terminado

    //Solo para Dinamicas
	const REALIZADO = 3; //Dinámica culminada satisfactoriamente
	const CAIDO = 4;  //no ralizado por proble por los invitados
	const ANULADO = 5; //Dinámica rechazada por problemas con los participantes (no cumplian los requerimientos) u otro factor externo
	const CANCELADO = 6; //Dinámica no realizada por solicitud del cliente
	const REPROGRAMADO = 7;//Dinámica que ha cambiado de fecha de realización ¿Cómo se maneja en el PyP? ¿Se genera una nueva dinámica o solo se cambia la fecha?

}

class Status_SystemRecluited
{

    //Para Dinamcias y Proyectos
    const DISPONIBLE = 0;//Reclutado disponible para ser invitado
    const SUSPENDIDO = 1; //Reclutado no disponible por que está participando en un evento ¿cómo evitar invitar a un reclutado que puede volverse participante?
    const RETIRADO = 2; //Reclutado retirado por que ya ha participado en 3 eventos

}

class Status_recruitment
{
    const RECLUTADO=0;//Se refiere a los Reclutados postulados a una dinámica
    const INVITADO=1;//Se refiere a los Reclutados que han pasado el Filtro Telefónico
    const PARTICIPANTE=2;//Se refiere a los Reclutados pasan por el filtro presencial analista
    const CANCELADO=3;//Se refiere al Reclutado canceló su participación al evento? Cual fuera el evance en su validación.

}



