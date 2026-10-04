<script setup lang="ts">
import AddBadge from "@/core/components/badges/AddBadge.vue";
import AppLayout from "@/layouts/AppLayout.vue";
import BaseBadge from "@/core/components/badges/BaseBadge.vue";
import BooleanBadge from "@/core/components/badges/BooleanBadge.vue";
import Card from "@/core/components/Card.vue";
import ComponentReference from "@/features/components/ComponentReference.vue";
import CopyBadge from "@/core/components/badges/CopyBadge.vue";
import DeleteBadge from "@/core/components/badges/DeleteBadge.vue";
import EditBadge from "@/core/components/badges/EditBadge.vue";
import ExampleComponent from "@/features/components/ExampleComponent.vue";

const referenceProperties = [
    {
        property: "circle",
        type: "boolean",
        default: "false",
        required: false,
        description: "Makes the badge borders as round as possible.",
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
        property: "pointer",
        type: "boolean",
        default: "false",
        required: false,
        description: "Changes the cursor over the badge to a pointer.",
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
        description: "Default slot for content inside badge",
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
                Collection of small badge components to display inline with
                existing text.
            </p>
        </Card>
        <div class="flex justify-center gap-2">
            <Card title="Badge Components">
                <div class="flex flex-col gap-2">
                    <div class="flex flex-wrap">
                        <BaseBadge text="Base" />
                        <div>
                            <span class="hidden md:inline">&nbsp;- </span>
                            Base Badge
                        </div>
                    </div>
                    <div class="flex flex-wrap">
                        <AddBadge />
                        <div>
                            <span class="hidden md:inline">&nbsp;- </span>
                            Add Badge
                        </div>
                    </div>
                    <div class="flex flex-wrap">
                        <BooleanBadge :value="true" />
                        <div>
                            <span class="hidden md:inline"> - </span>
                            Boolean Badge True
                        </div>
                    </div>
                    <div class="flex flex-wrap">
                        <BooleanBadge :value="false" />
                        <div>
                            <span class="hidden md:inline">&nbsp;- </span>
                            Boolean Badge False
                        </div>
                    </div>
                    <div class="flex flex-wrap">
                        <DeleteBadge />
                        <div>
                            <span class="hidden md:inline">&nbsp;- </span>
                            Delete Badge
                        </div>
                    </div>
                    <div class="flex flex-wrap">
                        <EditBadge />
                        <div>
                            <span class="hidden md:inline">&nbsp;- </span>
                            Edit Badge
                        </div>
                    </div>
                    <div class="flex flex-wrap">
                        <CopyBadge />
                        <div>
                            <span class="hidden md:inline">&nbsp;- </span>
                            Copy Badge
                        </div>
                    </div>
                </div>
            </Card>
            <Card title="Badge Variants">
                <div class="flex flex-wrap gap-2">
                    <BaseBadge class="flex-1" text="Danger" variant="danger" />
                    <BaseBadge class="flex-1" text="Dark" variant="dark" />
                    <BaseBadge class="flex-1" text="Error" variant="error" />
                    <BaseBadge class="flex-1" text="Help" variant="help" />
                    <BaseBadge class="flex-1" text="Info" variant="info" />
                    <BaseBadge class="flex-1" text="Light" variant="light" />
                    <BaseBadge
                        class="flex-1"
                        text="Primary"
                        variant="primary"
                    />
                    <BaseBadge
                        class="flex-1"
                        text="Secondary"
                        variant="secondary"
                    />
                    <BaseBadge
                        class="flex-1"
                        text="Success"
                        variant="success"
                    />
                    <BaseBadge
                        class="flex-1"
                        text="Warning"
                        variant="warning"
                    />
                    <BaseBadge class="flex-1" text="None" variant="none" />
                </div>
            </Card>
            <Card title="Badge Sizes">
                <div class="flex flex-col gap-1 items-center">
                    <div>
                        <BaseBadge text="Large" size="lg" />
                    </div>
                    <div>
                        <BaseBadge text="Medium" size="md" />
                    </div>
                    <div>
                        <BaseBadge text="Small" size="sm" />
                    </div>
                    <div>
                        <BaseBadge text="Large Circle" size="lg" circle />
                    </div>
                    <div>
                        <BaseBadge text="Medium Circle" size="md" circle />
                    </div>
                    <div>
                        <BaseBadge text="Small Circle" size="sm" circle />
                    </div>
                </div>
            </Card>
        </div>
        <ExampleComponent>
            <template #component>
                <div class="text-center">
                    <BaseBadge text="Badge Text" variant="primary" />
                </div>
            </template>
            <template #code>
                &lt;script setup&gt; <br />
                &emsp;import BaseBadge from
                "@/core/components/badges/BaseBadge.vue" <br />
                &lt;/script&gt;<br />
                <br />
                &lt;template&gt;<br />
                &emsp;&lt;BaseBadge text="Badge Text" variant="primary" /&gt;<br />
                &lt;/template&gt;<br />
            </template>
        </ExampleComponent>
        <ComponentReference
            :reference-properties="referenceProperties"
            :slot-properties="slotProperties"
        />
    </div>
</template>
