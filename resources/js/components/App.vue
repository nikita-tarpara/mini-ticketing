<template>
    <div class="container mx-auto p-4">
        <!-- New Ticket Button -->
        <button @click="openModal(null)" class="bg-blue-500 text-white px-4 py-2 rounded mb-4">
            New Ticket
        </button>

        <!-- Ticket Table -->
        <TicketList
            :tickets="tickets"
            @ticketDeleted="fetchTickets"
            @editTicket="openModal"
        />

        <!-- Modal Popup -->
        <div v-if="showModal" class="fixed inset-0 bg-black bg-opacity-50 flex justify-center items-center">
            <div class="bg-white p-6 rounded-lg shadow-lg w-96">
                <h2 class="text-xl font-semibold mb-4">{{ selectedTicket ? 'Edit Ticket' : 'New Ticket' }}</h2>

                <TicketForm
                    :ticketToEdit="selectedTicket"
                    @ticketCreated="handleTicketChange"
                    @ticketUpdated="handleTicketChange"
                    @clearEdit="closeModal"
                />

                <button @click="closeModal" class="mt-4 bg-gray-500 text-white px-4 py-2 rounded w-full">
                    Close
                </button>
            </div>
        </div>
    </div>
</template>

<script>
import { ref, onMounted } from 'vue';
import TicketForm from './TicketForm.vue';
import TicketList from './TicketList.vue';
import axios from 'axios';

export default {
    components: {
        TicketForm,
        TicketList
    },
    setup() {
        const tickets = ref([]);
        const selectedTicket = ref(null);
        const showModal = ref(false);

        const fetchTickets = async () => {
            try {
                const response = await axios.get('/api/tickets');
                tickets.value = response.data;
            } catch (error) {
                console.error('Error fetching tickets', error);
            }
        };

        const openModal = (ticket) => {
            selectedTicket.value = ticket ? { ...ticket } : { id: null, title: '', description: '', status: 'open' };
            showModal.value = true;
        };

        const closeModal = () => {
            selectedTicket.value = null;
            showModal.value = false;
        };

        // Refresh tickets and close modal when a ticket is created or updated
        const handleTicketChange = async () => {
            await fetchTickets();
            closeModal();
        };

        onMounted(fetchTickets);

        return { tickets, fetchTickets, selectedTicket, showModal, openModal, closeModal, handleTicketChange };
    }
};
</script>
