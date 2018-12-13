import axios from 'axios';
import {apiPrefix} from '../etc/config.json';

export default {
    getSlot(slotElementId) {
        return axios.get(`${apiPrefix}/${slotElementId}`);
    },

    updateSlot(slotElementId, data) {
        return axios.post(`${apiPrefix}/${slotElementId}`, data);
    },
}
