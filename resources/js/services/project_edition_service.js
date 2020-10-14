import {http, httpFile} from './http_service';

export function createProjectEdition(data) {
    return httpFile().post('/painel/projetos', data);
}

export function deleteProjectEdition(id) {
    return http().delete(`painel/projetos/${id}`);
}

export function updateProjectEdition(id, data) {
    return http().post(`painel/projetos/${id}`, data);
}

export function statusProjectEdition(id) {
    return http().post(`painel/projetos/status/${id}`);
}