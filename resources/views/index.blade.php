<!DOCTYPE html>
<html lang="pt_br">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Desafio Avelar</title>

    @vite(['resources/sass/app.scss', 'resources/js/app.js'])

    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css">

    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.10/jquery.mask.js"></script>
</head>
<body>
    <div class="container mt-3">
        <div class="card">
            <div class="card-header d-flex justify-content-between">
                <h5 class="card-title">Registros</h5>
                <button type="button" class="btn btn-sm btn-primary" data-bs-toggle="modal" data-bs-target="#cadastro">Criar</button>
            </div>
        </div>

        <table class="table table-striped table-hover mt-3">
            <thead>
                <th>#</th>
                <th>Nome</th>
                <th>Idade</th>
                <th>Sexo</th>
                <th>Salário</th>
                <th>Anexo</th>
                <th>Opções</th>
            </thead>
            <tbody>
                @forelse ($dados as $dado)
                    <tr>
                        <td>{{ $dado->id }}</td>
                        <td>{{ $dado->nome }}</td>
                        <td>{{ $dado->idade }} anos</td>
                        <td>{{ $dado->sexo }}</td>
                        <td>R$ {{ number_format($dado->salario, 2, ',', '.') }}</td>
                        <td>
                            @if(substr($dado->anexo, -4) == '.pdf')
                                <a href="{{ route('desafio.avelar.pdf', ['id' => $dado->id]) }}" class="btn btn-sm btn-outline-danger" target="_blank"><i class="fas fa-file-pdf"></i></a>
                            @else
                                <button type="button" class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#visualizar-anexo-{{ $dado->id }}"><i class="fas fa-image"></i></button>
                            @endif
                        </td>
                        <td>
                            <div class="d-flex justify-content-between">
                                <button type="button" class="btn btn-sm btn-outline-info" data-bs-toggle="modal" data-bs-target="#visualizar-{{ $dado->id }}"><i class="fas fa-eye"></i></button>
                                <button type="button" class="btn btn-sm btn-outline-warning" data-bs-toggle="modal" data-bs-target="#atualizar-{{ $dado->id }}"><i class="fas fa-edit"></i></button>
                                <button type="button" class="btn btn-sm btn-outline-danger" onclick="excluir({{ $dado->id }})"><i class="fas fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>

                    {{-- Modal de Visualização de Anexo (.jpg, .png) --}}
                    <div class="modal fade" id="visualizar-anexo-{{ $dado->id }}">
                        <div class="modal-dialog modal-dialog-centered modal-dialog-scrollable modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Anexo - {{ $dado->nome }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                                </div>
                                <div class="modal-body">
                                    <img src="{{ url($dado->anexo) }}" alt="" class="img-fluid">
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Modal de Visualização de Dados --}}
                    <div class="modal fade" id="visualizar-{{ $dado->id }}">
                        <div class="modal-dialog modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">{{ $dado->nome }}</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                                </div>
                                <div class="modal-body">
                                    @include('components.visualizar-dados')
                                </div>
                            </div>
                        </div>
                    </div>

                    {{-- Modal de Atualização de dados --}}
                    <div class="modal fade" id="atualizar-{{ $dado->id }}">
                        <div class="modal-dialog modal-dialog-scrollable">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title">Atualizar Dados</h5>
                                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                                </div>
                                <div class="modal-body">
                                    @include('components.form-atualizar')
                                </div>
                            </div>
                        </div>
                    </div>
                @empty
                    <tr>
                        <td colspan="7">Nenhum registro encontrado.</td>
                    </tr>
                @endforelse
            </tbody>
        </table>

        {{-- Modal de Cadasto --}}
        <div class="modal fade" id="cadastro" data-bs-backdrop="static">
            <div class="modal-dialog modal-dialog-scrollable">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Cadastrar</h5>
                        <button class="btn-close" data-bs-dismiss="modal" aria-label="Fechar"></button>
                    </div>
                    <div class="modal-body">
                        @include('components.form-cadastro')
                    </div>
                </div>
            </div>
        </div>

        {{-- Formulário de Exclusão --}}
        <form action="{{ route('desafio.avelar.delete') }}" method="post" id="form_excluir">
            @csrf
            @method('DELETE')

            <input type="hidden" name="id" id="id_excluir" value="">
        </form>
    </div>

    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    <script type="module">
        $(document).ready(function(){
            $('.cep').mask("99.999-999");
            $('.salario').mask("#.##0,00", {reverse: true});
        });
    </script>

    <script>
        function excluir(id) {
            let id_dado = id;

            Swal.fire({
                title: "Deseja mesmo excluir este registro?",
                showCancelButton: true,
                confirmButtonText: "Sim, continuar",
                cancelButtonText: "Não, cancelar"
            }).then((result) => {
                if (result.isConfirmed) {
                    document.getElementById('id_excluir').value = id_dado;
                    document.getElementById('form_excluir').submit();
                }
            });
        }
    </script>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: "success",
                text: "{{ session('success') }}"
            });
        </script>
    @elseif (session('error'))
        <script>
            Swal.fire({
                icon: "error",
                title: "Oops...",
                text: "{{ session('error') }}"
            })
        </script>
    @endif
</body>
</html>
