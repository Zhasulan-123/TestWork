import httpClient from "@/api/http.service";

/**
 * Created by TheCodeholic on 6/7/2022.
 */
const pageService = {
    create(page) {
        return httpClient.post('page', page)
    },
    get() {
        return httpClient.get('pages')
    },
    getId(id) {
        return httpClient.get(`page/${id}`)
    },
    update(page) {
        return httpClient.put(`page/${page.id}`, page)
    },
    delete(pageId) {
        return httpClient.delete(`page/${pageId}`)
    }
};

export default pageService;