<template>
    <div class="mb-6">
        <table class="w-full border-collapse border border-gray-300">
            <thead>
            <tr class="bg-gray-200">
                <th class="border border-gray-300 p-2">Title</th>
                <th class="border border-gray-300 p-2">Description</th>
                <th class="border border-gray-300 p-2">Status</th>
                <th class="border border-gray-300 p-2">Actions</th>
            </tr>
            </thead>
            <tbody>
            <tr v-for="ticket in tickets" :key="ticket.id" class="text-center">
                <td class="border border-gray-300 p-2">{{ ticket.title }}</td>
                <td class="border border-gray-300 p-2">{{ ticket.description }}</td>
                <td class="border border-gray-300 p-2">{{ ticket.status }}</td>
                <td class="border border-gray-300 p-2">
                    <button
                        @click="$emit('editTicket', ticket)"
                        class="bg-yellow-500 text-white px-3 py-1 rounded mr-2"
                    >
                        Edit
                    </button>
                    <button
                        @click="deleteTicket(ticket.id)"
                        class="bg-red-500 text-white px-3 py-1 rounded"
                    >
                        Delete
                    </button>
                </td>
            </tr>
            </tbody>
        </table>
    </div>
</template>

<script>
export default {
    props: ['tickets'],
    methods: {
        editTicket(ticket) {
            this.$emit('editTicket', ticket); // Send ticket data to parent
        },
        async deleteTicket(id) {
            try {
                await axios.delete(`/api/tickets/${id}`);
                this.$emit('ticketDeleted');
            } catch (error) {
                console.error('Error deleting ticket', error);
            }
        }
    }
};
</script>
