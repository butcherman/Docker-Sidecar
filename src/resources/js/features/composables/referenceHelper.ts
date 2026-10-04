import { useColumnBuilder } from "@/core/features/dataResources/composables/columnBuilder";

interface propColumns {
    property: string;
    type: string;
    default: string;
    required: boolean;
    description: string;
}

interface slotColumns {
    name: string;
    params: string;
    description: string;
}

export const useReferenceHelper = () => {
    const getPropColumns = () => {
        const col = useColumnBuilder<propColumns>();

        return [
            col.text("property", "Name", {
                filterable: false,
                sort: false,
            }),
            col.text("type", "Type", {
                filterable: false,
                sort: false,
            }),
            col.text("default", "Default", {
                filterable: false,
                sort: false,
            }),
            col.boolean("required", "Required", {
                filterable: false,
                sort: false,
            }),
            col.text("description", "Description", {
                filterable: false,
                sort: false,
            }),
        ];
    };

    const getSlotColumns = () => {
        const col = useColumnBuilder<slotColumns>();

        return [
            col.text("name", "Name", {
                filterable: false,
                sort: false,
            }),
            col.text("params", "Parameters", {
                filterable: false,
                sort: false,
            }),
            col.text("description", "Description", {
                filterable: false,
                sort: false,
            }),
        ];
    };

    return {
        getPropColumns,
        getSlotColumns,
    };
};
