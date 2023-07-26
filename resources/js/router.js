
import Vue from 'vue';
import Router from 'vue-router';

Vue.use(Router);


/*
import Home from './views/admin/pages/Home';
import Tags from './views/admin/pages/Tags';
import Category from './views/admin/pages/Category';
import AdminUsers from './views/admin/pages/AdminUsers';
import Login from './views/admin/pages/Login';
import Role_old from './views/admin/pages/Role_old';
import AssignRole from './views/admin/pages/AssignRole';
import CreateBlog from './views/admin/pages/CreateBlog';
*/

//back

import Home from './views/admin/pages/Home';
import Role from './views/admin/pages/Role';
import Permission from './views/admin/pages/Permission';
import User from './views/admin/pages/User';
import AdminShow from './views/admin/pages/AdminShow';

import Persona from './views/back/persona/Persona';
import Aula from './views/back/aula/Aula';
import Matricula from './views/back/matricula/Matricula';



import Extraordinario from './views/back/extraordinario/Extraordinario';
import AtencionExtraordinario from './views/back/extraordinario/AtencionExtraordinario';
import Suministro from './views/back/suministro/Suministro';
import Correo from './views/back/correo/correo';
import Sede from './views/back/sede/sede';
import Empresa from './views/back/empresa/empresa';
import Atencion from './views/back/atencion/atencion';
import EstadisticaAtencion from './views/back/atencion/estadisticaAtencion';
import RegistroCorreo from './views/back/atencion/registroCorreo';

import Aprende from './views/back/aprende/aprende';

import ActualizacionDatos from './views/back/datosSuministro/actualizacionDatos';


//service

import HomeService from './views/service/pages/HomeService';
import ExtraordinarioService from './views/service/extraordinario/ExtraordinarioService';
import TecnicoService from './views/service/tecnico/TecnicoService';
import AtencionService from './views/service/atencion/AtencionService';


//front
import Profile from './views/admin/pages/Profile';
import Profile2 from './views/admin/pages/Profile2';


//registros
import RegEstudiante from './views/registro/estudiante/RegEstudiante';


//front - reclamos
import Reclamo from './views/front/cliente/reclamo';
import Contactenos from './views/front/cliente/contactenos';
import LugarPago from './views/front/cliente/lugarPago';
import Orientacion from './views/front/cliente/orientacion';


//RER
import HomeRer from './views/rer/pages/HomeRer';
import SuministroRer from './views/rer/atencion/SuministroRer';

//TEST
import Pdftest from './views/back/test/pdftest';


//REPOSITORIO
import Repositoriotest from './views/repositorio/test';
import Tareas from './views/repositorio/asignacion/tareas';
import Reportes from './views/repositorio/asignacion/reportes';
import TareasReportesAsignados from './views/repositorio/colaborador/tareasReportesAsignados';
import EstadoTareas from './views/repositorio/colaborador/estadoTareas';
import Solicitudes from './views/repositorio/colaborador/solicitudes';
import ResumenReportes from './views/repositorio/reporte/resumenReportes';

//FILE
import FileWelcome from './views/File/fileWelcome';


const routes = [
    {
        path: '/back/home',
        component: Home,
        name: 'home',
    },
    {
        
        path: '/back/adminshow',
        component: AdminShow,
        name: 'admin',
    },
    {
        path: '/back/role',
        //path: '/role',
        component: Role,
        name: 'role',
    },
    {
        path: '/back/permission',
        component: Permission,
        name: 'permission',
    },

    {
        path: '/back/user',
        component: User,
        name: 'user',
    },

    {
        path: '/back/persona',
        component: Persona,
        name: 'persona',
    },

    {
        path: '/back/aula',
        component: Aula,
        name: 'aula',
    },

    {
        path: '/back/matricula',
        component: Matricula,
        name: 'matricula',
    },

    ////////////////////////////////////////

    {
        path: '/back/extraordinario',
        component: Extraordinario,
        name: 'extraordinario',
    }, 
    {
        path: '/back/atencionextraordinario',
        component: AtencionExtraordinario,
        name: 'atencionextraordinario',
    },

    {
        path: '/back/suministro',
        component: Suministro,
        name: 'suministro',
    },

    {
        path: '/back/correo',
        component: Correo,
        name: 'correo',
    },

    {
        path: '/back/empresa',
        component: Empresa,
        name: 'empresa',
    },

    {
        path: '/back/sede',
        component: Sede,
        name: 'sede',
    },

    {
        path: '/back/atencion',
        component: Atencion,
        name: 'atencion',
    },

    {
        path: '/back/estadisticaAtencion',
        component: EstadisticaAtencion,
        name: 'estadisticaAtencion',
    },

    {
        path: '/back/registroCorreo',
        component: RegistroCorreo,
        name: 'registroCorreo',
    },

    {
        path: '/back/aprende',
        component: Aprende,
        name: 'aprende',
    },

    {
        path: '/back/actualizacionDatos',
        component: ActualizacionDatos,
        name: 'actualizacionDatos',
    },


    //SERVICE


    {
        path: '/service/extraordinarioService',
        component: ExtraordinarioService,
        name: 'extraordinarioservice',
    }, 

    {
        path: '/service/tecnicoService',
        component: TecnicoService,
        name: 'tecnicoservice',
        //props: true
    }, 

    {
        path: '/service/atencionService',
        component: AtencionService,
        name: 'atencionService',
        props: true
    }, 

    {
        path: '/service/homeService',
        component: HomeService,
        name: 'homeService',
        //props: true
    }, 




    

    //FRONTOFFICE

    {
        path: '/front/profile',
        component: Profile,
        name: 'profile',
    },
    {
        path: '/front/profile2',
        component: Profile2,
        name: 'profile2',
    },

    ////front reclamo


    {
        path: '/front/contactenos',
        component: Contactenos,
        name: 'contactenos',
    },
    {
        path: '/front/lugarPago',
        component: LugarPago,
        name: 'lugarPago',
    },
    {
        path: '/front/orientacion',
        component: Orientacion,
        name: 'orientacion',
    },
    {
        path: '/front/reclamo',
        component: Reclamo,
        name: 'reclamo',
    },


    //REGISTROS

    {
        path: '/registro/regEstudiante',
        component: RegEstudiante,
        name: 'regEstudiante',
    },


    //RER

    {
        path: '/rer/homerer',
        component: HomeRer,
        name: 'homerer',
    },
    {
        path: '/rer/suministrorer',
        component: SuministroRer,
        name: 'suministrorer',
    },

    //RER

    {
        path: '/back/pdftest',
        component: Pdftest,
        name: 'pdftest',

    },

//REPOSITORIO


    {
        path: '/repositorio/test',
        component: Repositoriotest,
        name: 'testRepositorio',

    },

    {
        path: '/repositorio/tareas',
        component: Tareas,
        name: 'tareas',

    },


    {
        path: '/repositorio/reportes',
        component: Reportes,
        name: 'reportes',

    },

    {
        path: '/repositorio/tareasReportesAsignados',
        component: TareasReportesAsignados,
        name: 'tareasReportesAsignados',

    },

    {
        path: '/repositorio/estadoTareas',
        component: EstadoTareas,
        name: 'estadoTareas',

    },

    {
        path: '/repositorio/solicitudes',
        component: Solicitudes,
        name: 'solicitudes',

    },

    {
        path: '/repositorio/resumenReportes',
        component: ResumenReportes,
        name: 'resumenReportes',

    },


//FILE

    {
        path: '/repositorio/fileWelcome',
        component: FileWelcome,
        name: 'fileWelcome',

    },




   /* {
        path: '/',
        component: Home,
        name: 'home',
    },
    {
        path: '/login',
        component: Login,
        name: 'login',
    },
    {
        path: '/tags',
        component: Tags,
        name: 'tags',
    },
    {
        path: '/category',
        //name: 'tags',
        component: Category,
        name: 'category',
    },
    {
        path: '/createBlog',
        //name: 'tags',
        component: CreateBlog,
        name: 'createBlog',
    },
    {
        path: '/adminusers',
        //name: 'tags',
        component: AdminUsers,
        name: 'adminusers',
    },
    {
        path: '/role',
        //name: 'tags',
        component: Role,
        name: 'role',
    },
    {
        path: '/assignrole',
        //name: 'tags',
        component: AssignRole,
        name: 'assignrole',
    },*/
    
]


export default new Router({
    mode: 'history',
    routes
});
