import {http, httpFile} from './http_service';

export function createProject(data) {
    return httpFile().post('/painel/projetos', data);
}

export function deleteProject(id) {
    return http().delete(`painel/projetos/${id}`);
}

export function updateProject(id, data) {
    return http().post(`painel/projetos/${id}`, data);
}

export function statusProject(id) {
    return http().post(`painel/projetos/status/${id}`);
}