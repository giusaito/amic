import {http, httpFile} from './http_service';

export function createTvAmic(data) {
    return httpFile().post('/painel/tv-amic', data);
}
export function processVideo(data) {
    return httpFile().post('/painel/tv-amic/process-video', data);
}

export function deleteTvAmic(id) {
    return http().delete(`painel/tv-amic/${id}`);
}

export function updateTvAmic(id, data) {
    return http().post(`painel/tv-amic/${id}`, data);
}

export function statusTvAmic(id) {
    return http().post(`painel/tv-amic/status/${id}`);
}