<template>
    <div class="mb-6">
        <form @submit.prevent="submitForm">
            <div class="flex flex-col space-y-4">
                <input
                    v-model="formData.title"
                    type="text"
                    placeholder="Ticket Title"
                    class="border border-gray-300 p-2 rounded"
                    required
                />
                <textarea
                    v-model="formData.description"
                    placeholder="Ticket Description"
                    class="border border-gray-300 p-2 rounded"
                    required
                ></textarea>
                <select v-model="formData.status" class="border border-gray-300 p-2 rounded" required>
                    <option value="open">Open</option>
                    <option value="in_progress">In Progress</option>
                    <option value="closed">Closed</option>
                </select>
                <button type="submit" class="bg-blue-500 text-white p-2 rounded">
                    {{ formData.id ? 'Update Ticket' : 'Create Ticket' }}
                </button>
                <button v-if="formData.id" type="button" @click="clearForm" class="bg-gray-500 text-white p-2 rounded ml-2">
                    Cancel
                </button>
            </div>
        </form>
    </div>
</template>

<script>
import axios from 'axios';

export default {
    props: {
        ticketToEdit: {
            type: Object,
            default: null
        }
    },
    data() {
        return {
            formData: {
                id: null,
                title: '',
                description: '',
                status: 'open'
            }
        };
    },
    watch: {
        ticketToEdit: {
            handler(newTicket) {
                if (newTicket) {
                    this.formData = { ...newTicket }; // Copy ticket data
                } else {
                    this.clearForm();
                }
            },
            immediate: true
        }
    },
    methods: {
        async submitForm() {
            try {
                if (this.formData.id) {
                    // Update existing ticket
                    await axios.put(`/api/tickets/${this.formData.id}`, this.formData);
                    this.$emit('ticketUpdated');
                } else {
                    // Create new ticket
                    await axios.post('/api/tickets', this.formData);
                    this.$emit('ticketCreated');
                }
                this.clearForm();
            } catch (error) {
                console.error('Error submitting ticket', error);
            }
        },
        clearForm() {
            this.formData = { id: null, title: '', description: '', status: 'open' };
            this.$emit('clearEdit'); // Notify parent to clear editing state
        }
    }
};
</script>
