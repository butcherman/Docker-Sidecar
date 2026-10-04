<template>
    <div class="flex flex-col gap-2">
        <p>
            Build table columns by using the built in Column Builder functions.
            Available column types:
        </p>
        <ul class="list-disc list-inside">
            <li>Text Column</li>
            <li>Boolean Column</li>
            <li>Icon Column</li>
            <li>Date Column</li>
            <li>Phone Number Column</li>
        </ul>
        <p>Each Column Builder takes two properties with an optional third.</p>
        <ul class="list-disc list-inside">
            <li>dataField - Field that holds value for row</li>
            <li>columnLabel - Label for the column header</li>
            <li>{options} - Customizable options</li>
        </ul>
    </div>
</template>
