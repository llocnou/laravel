@php
    // Función que devuelve los elementos que pertenecen al PARENT.
    function searchChildren($items, $parent)
    {
        $ret = [];
        foreach ($items as $item) {
            if ($parent == $item->parent_id) {
                $ret[] = $item;
            }
        }
        return $ret;
    }

    // Pintar recursivamente la estructura de directorio
    // Empezando por la raíz del sistema
    function drawFileSystem($dirs, $files, $parent)
    {
        echo "<!-- Draw File System -->\n";
        echo "<ul>\n";
        // Archivos
        $archivos = searchChildren($files, $parent);
        if (sizeof($archivos) > 0) {
            foreach ($archivos as $archivo) {
                echo "<li class='file'>";
                echo "<a href='" . route('dashboard.show', $archivo->inodes_id) . "'>";
                echo "🗋 $archivo->name";
                echo '</a></li>';
            }
        } else {
            echo '<li>Directorio vacio</li>';
        }
        // Subdirectorios
        $carpetas = searchChildren($dirs, $parent);
        if (sizeof($carpetas) > 0) {
            foreach ($carpetas as $carpeta) {
                echo "<li class='dir'>";
                echo "<a href='" . route('dashboard.show', $carpeta->id) . "'>";
                echo "🗁 $carpeta->name";
                echo '</a></li>';
                drawFileSystem($dirs, $files, $carpeta->id);
            }
        }
        echo '</ul>';
    }
@endphp
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="">
        <div class='inodes'>
            <ul>
                <li class="breadcrumb-item"><a href="{{ route('dashboard') }}">🖫 {{ __('myDrive') }}</a></li>
                @php
                    drawFileSystem($dirs, $files, 0);
                @endphp
            </ul>
        </div>

    </div>
</x-app-layout>
