import {apiPrefix} from '../etc/config.json';
import axios from 'axios';

export default {
    getSlot(slotElementId) {
        return axios.get(`${apiPrefix}/${slotElementId}`);
    },

    updateSlot(slotElementId, data) {
        return axios.post(`${apiPrefix}/${slotElementId}`, data);
    },
}
