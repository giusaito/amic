import {http, httpFile} from './http_service';

export function createProject(data) {
    return httpFile().post('/painel/projetos', data);
}

export function deleteProject(id) {
    return http().delete(`painel/projetos/${id}`);
}