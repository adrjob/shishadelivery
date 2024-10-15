// Função para obter a classe CSS baseada no status e tipo (order, shipment, cashback)
export function getStatusClass(status, type) {
    if (
        (type === "order" && status === "completed") ||
        (type === "shipment" && status === "Delivered") ||
        (type === "cashback" && status === "paid") ||
        (type === "shipment" && status === "Order Received")
    ) {
        return "inline-flex items-center gap-1 rounded-full bg-green-50 text-green-600 px-2 py-1 text-xs font-semibold dark:bg-green-600 dark:text-green-100";
    }

    // Qualquer outro status
    return "inline-flex items-center gap-1 rounded-full bg-yellow-50 text-yellow-600 px-2 py-1 text-xs font-semibold dark:bg-yellow-600 dark:text-yellow-100";
}

// Função para obter a cor do indicador de status
export function getStatusColor(status, type) {
    if (
        (type === "order" && status === "completed") ||
        (type === "shipment" && status === "Delivered") ||
        (type === "cashback" && status === "paid") ||
        (type === "shipment" && status === "Order Received")
    ) {
        return "h-1.5 w-1.5 rounded-full bg-green-600 dark:bg-green-100";
    }

    // Qualquer outro status
    return "h-1.5 w-1.5 rounded-full bg-yellow-600 dark:bg-yellow-100";
}
