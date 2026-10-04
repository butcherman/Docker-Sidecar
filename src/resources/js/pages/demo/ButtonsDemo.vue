<script setup lang="ts">
import AddButton from "@/core/components/buttons/AddButton.vue";
import AlertButton from "@/core/components/buttons/AlertButton.vue";
import AppLayout from "@/layouts/AppLayout.vue";
import BaseButton from "@/core/components/buttons/BaseButton.vue";
import Card from "@/core/components/Card.vue";
import ComponentReference from "@/features/components/ComponentReference.vue";
import EditButton from "@/core/components/buttons/EditButton.vue";
import ExampleComponent from "@/features/components/ExampleComponent.vue";
import SubmitButton from "@/core/components/buttons/SubmitButton.vue";

const referenceProperties = [
    {
        property: "async",
        type: "boolean",
        default: "false",
        required: false,
        description:
            "Determines if the url link will be treated as a regular Inertia link, or an ASYNC Inertia link.",
    },
    {
        property: "flat",
        type: "boolean",
        default: "false",
        required: false,
        description: "Removes component shadowing.",
    },
    {
        property: "href",
        type: "string",
        default: "null",
        required: false,
        description:
            " When set the component will act as an Inertia  hyperlink.",
    },
    {
        property: "icon",
        type: "string",
        default: "null",
        required: false,
        description: "Places a FontAwesome icon in front of the text.",
    },
    {
        property: "pill",
        type: "boolean",
        default: "false",
        required: false,
        description: "Rounds out the edges of the border to the max.",
    },
    {
        property: "text",
        type: "string",
        default: "null",
        required: false,
        description: "Text to be placed in the button.",
    },
    {
        property: "size",
        type: "ComponentSize",
        default: "md",
        required: false,
        description: "Size of the component.",
    },
    {
        property: "variant",
        type: "VariantType",
        default: "primary",
        required: false,
        description: "Background and text colors for the comoponent.",
    },
];

const slotProperties = [
    {
        name: "default",
        params: "none",
        description: "Default slot for content inside button",
    },
];
</script>

<script lang="ts">
export default { layout: AppLayout };
</script>
<template>
    <div class="flex flex-col gap-2">
        <Card title="Description">
            <p class="text-center">
                Collection of customizable button components.
            </p>
        </Card>
        <div class="flex justify-center gap-2">
            <Card title="Button Components">
                <div class="flex flex-col gap-2">
                    <BaseButton text="Base Button" />
                    <AddButton text="Add Button" />
                    <AlertButton text="Alert Button" />
                    <EditButton text="Edit Button" />
                    <SubmitButton text="SubmitButton" />
                </div>
            </Card>
            <Card title="Button Variants">
                <div class="flex flex-wrap gap-2">
                    <BaseButton class="flex-1" text="Danger" variant="danger" />
                    <BaseButton class="flex-1" text="Dark" variant="dark" />
                    <BaseButton class="flex-1" text="Error" variant="error" />
                    <BaseButton class="flex-1" text="Help" variant="help" />
                    <BaseButton class="flex-1" text="Info" variant="info" />
                    <BaseButton class="flex-1" text="Light" variant="light" />
                    <BaseButton
                        class="flex-1"
                        text="Primary"
                        variant="primary"
                    />
                    <BaseButton
                        class="flex-1"
                        text="Secondary"
                        variant="secondary"
                    />
                    <BaseButton
                        class="flex-1"
                        text="Success"
                        variant="success"
                    />
                    <BaseButton
                        class="flex-1"
                        text="Warning"
                        variant="warning"
                    />
                    <BaseButton class="flex-1" text="None" variant="none" />
                    <BaseButton class="flex-1" text="Flat" flat />
                </div>
            </Card>
            <Card title="Button Sizes">
                <div class="flex flex-col gap-2">
                    <BaseButton text="Large" size="lg" />
                    <BaseButton text="Medium" size="md" />
                    <BaseButton text="Small" size="sm" />
                    <BaseButton text="Large Pill" size="lg" pill />
                    <BaseButton text="Medium Pill" size="md" pill />
                    <BaseButton text="Small Pill" size="sm" pill />
                </div>
            </Card>
        </div>
        <ExampleComponent>
            <template #component>
                <div class="flex justify-center mb-2">
                    <BaseButton text="Any Button Text" variant="primary" />
                </div>
            </template>
            <template #code>
                &lt;script setup&gt; <br />
                &emsp;import BaseButton from
                "@/core/components/buttons/BaseButton.vue" <br />
                &lt;/script&gt;<br />
                <br />
                &lt;template&gt;<br />
                &emsp;&lt;BaseButton text="Any Button Text" variant="primary"
                /&gt;<br />
                &lt;/template&gt;<br />
            </template>
        </ExampleComponent>
        <div class="flex flex-col gap-2">
            <ComponentReference
                :reference-properties="referenceProperties"
                :slot-properties="slotProperties"
            />
        </div>
    </div>
</template>
