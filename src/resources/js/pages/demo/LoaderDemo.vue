<script setup lang="ts">
import AppLayout from "@/layouts/AppLayout.vue";
import AtomLoader from "@/core/components/loaders/AtomLoader.vue";
import Card from "@/core/components/Card.vue";
import ComponentReference from "@/features/components/ComponentReference.vue";
import EllipsisLoader from "@/core/components/loaders/EllipsisLoader.vue";
import ExampleComponent from "@/features/components/ExampleComponent.vue";
import HollowDotsLoader from "@/core/components/loaders/HollowDotsLoader.vue";
import SkeletonLoader from "@/core/components/loaders/SkeletonLoader.vue";
import TrinityRingsLoader from "@/core/components/loaders/TrinityRingsLoader.vue";

const referenceProperties = [
    {
        property: "text",
        type: "string",
        default: "false",
        required: false,
        description: "Text to show with the loader",
    },
    {
        property: "width",
        type: 'number | "auto"',
        default: "auto",
        required: false,
        description:
            "Only used on Skeleton Loader.  Determines width percentage of the loader.  Auto generates a random width.",
    },
];
</script>

<script lang="ts">
export default { layout: AppLayout };
</script>
<template>
    <div class="flex flex-col gap-2">
        <Card title="Description">
            <p class="text-center">Collection of animated loading icons.</p>
        </Card>
        <div class="flex justify-center gap-2">
            <Card title="Button Components">
                <div class="grid grid-cols-4 gap-2">
                    <div>
                        <AtomLoader text="Atom Loader" />
                    </div>
                    <EllipsisLoader text="Ellipsis Loader" />
                    <HollowDotsLoader text="HollowDotsLoader" />
                    <div class="flex flex-col gap-2">
                        <SkeletonLoader />
                        <SkeletonLoader />
                        <SkeletonLoader />
                        <p>Skeleton Loader</p>
                    </div>
                    <TrinityRingsLoader text="Trinity Rings Loader" />
                </div>
            </Card>
        </div>
        <div class="flex flex-col gap-2">
            <ExampleComponent show>
                <template #component>
                    <div class="flex justify-center mb-2">
                        <AtomLoader text="Atom Demo" />
                    </div>
                </template>
                <template #code>
                    &lt;script setup&gt; <br />
                    &emsp;import AtomLoader from
                    "@/core/components/loaders/AtomLoader.vue" <br />
                    &lt;/script&gt;<br />
                    <br />
                    &lt;template&gt;<br />
                    &emsp;&lt;AtomLoader text="Atom Demo" /&gt;<br />
                    &lt;/template&gt;<br />
                </template>
            </ExampleComponent>
            <ComponentReference :reference-properties="referenceProperties" />
        </div>
    </div>
</template>
