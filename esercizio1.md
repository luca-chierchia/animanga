# Descrizione del Progetto Aggiornata

Crea un'applicazione web che permetta agli utenti di:

- Aggiungere nuovi elementi (anime, manga o serie TV) al database con dettagli come titolo, autore/regista, anno di uscita, genere, numero totale di episodi/volumi, stato (completato, in corso, pianificato), ecc.
- Visualizzare la lista completa degli elementi nella loro collezione.
- Cercare elementi utilizzando vari criteri di filtraggio (titolo, autore/regista, genere, anno di uscita, stato).
- Modificare le informazioni di un elemento esistente.
- Eliminare elementi dalla collezione.
- Esportare e importare la collezione in formato JSON.
- Segnare gli episodi o capitoli come visti o letti, permettendo all'utente di tracciare il proprio progresso per ciascun elemento.

# Requisiti Tecnici Aggiornati

## MySQL

### Struttura del Database

- Tabella Principale (`media_items`): contiene le informazioni generali sugli elementi.
- Tabella del Progresso (`progress`): nuova tabella per memorizzare il progresso dell'utente per ogni elemento.

Campi della tabella `progress`:
- `progress_id` (INT, PRIMARY KEY, AUTO_INCREMENT)
- `media_item_id` (INT, FOREIGN KEY che riferisce a `media_items`)
- `episodes_watched` (INT)
- `chapters_read` (INT)
- `last_updated` (TIMESTAMP)

### Interazione con il Database

- Utilizza JOIN per combinare i dati tra `media_items` e `progress`.
- Esegui query per aggiornare il progresso quando l'utente segna episodi o capitoli come visti o letti.

## Programmazione Orientata agli Oggetti (OOP)

### Classi e Metodi Aggiornati

**Classe Base `MediaItem`**:
- Proprietà per le informazioni generali (titolo, autore, anno, ecc.).
- Metodi per creare, leggere, aggiornare ed eliminare elementi.

**Classi Derivate (`Anime`, `Manga`, `SerieTV`)**:
- Proprietà specifiche (numero di episodi, volumi, ecc.).
- Metodi per il Progresso:
    - `updateProgress(int $episodesWatched, int $chaptersRead): bool` – aggiorna il progresso nel database.
    - `getProgress(): array` – recupera il progresso corrente dal database.
    - `markAsCompleted(): bool` – segna l'elemento come completato quando il progresso raggiunge il totale.

### Tipizzazione

- Continua a utilizzare la tipizzazione scalare e la dichiarazione dei tipi di ritorno per tutte le funzioni e i metodi, specialmente quelli nuovi aggiunti per gestire il progresso.

### Array Associativi

- Utilizza array associativi per gestire i dati relativi al progresso quando interagisci con il database o con le form HTML.

Esempio:
```php
$progressData = [
    'media_item_id' => $mediaItemId,
    'episodes_watched' => $_POST['episodes_watched'] ?? 0,
    'chapters_read' => $_POST['chapters_read'] ?? 0,
];
```

## JSON

### Esportazione e Importazione Aggiornate

- Includi i dati del progresso nell'esportazione JSON.
- Assicurati che durante l'importazione, i dati del progresso siano correttamente inseriti nelle rispettive tabelle.

## Operatori Logici Vari

- Utilizza operatori logici per:
    - Determinare se un elemento è completato:
      ```php
      if ($episodesWatched >= $totalEpisodes && $chaptersRead >= $totalChapters) {
          // Segna come completato
      }
      ```
    - Filtrare gli elementi non ancora completati nelle query SQL:
      ```sql
      SELECT * FROM media_items mi
      LEFT JOIN progress p ON mi.media_item_id = p.media_item_id
      WHERE (mi.total_episodes > p.episodes_watched OR mi.total_chapters > p.chapters_read)
      ```

# Suggerimenti Implementativi

## Interfaccia Utente Semplice

### Form per Aggiornare il Progresso

- Crea una pagina o una sezione dedicata per ogni elemento dove l'utente può aggiornare il numero di episodi visti o capitoli letti.
- Usa campi input numerici per permettere all'utente di inserire il progresso.

### Visualizzazione del Progresso

- Mostra una barra di progresso o una percentuale accanto a ogni elemento nella lista.
  Esempio di calcolo della percentuale:
  ```php
  $progressPercentage = ($episodesWatched / $totalEpisodes) * 100;
  ```

## Validazione dei Dati

### Controlli Lato Server e Lato Client

- Verifica che i numeri inseriti non superino il totale di episodi o capitoli disponibili.
- Assicurati che i valori inseriti siano numeri interi non negativi.

## Esperienza Utente Migliorata

### Feedback all'Utente

- Mostra messaggi di conferma dopo l'aggiornamento del progresso.
- Notifica l'utente quando ha completato un elemento.

### Ordinamento e Filtraggio

- Permetti all'utente di ordinare la lista in base al progresso (ad esempio, dal meno al più completato).
- Filtra gli elementi per stato (completato, in corso, non iniziato).

# Obiettivi di Apprendimento Aggiornati

## MySQL

### Relazioni tra Tabelle

- Imparerai a creare e gestire relazioni uno-a-uno o uno-a-molti tra tabelle.
- Utilizzerai chiavi esterne e JOIN per combinare dati da tabelle correlate.

## OOP in PHP

### Metodi e Proprietà Avanzate

- Implementerai metodi per gestire stati interni complessi degli oggetti.
- Utilizzerai l'incapsulamento per proteggere e gestire i dati del progresso.

### Tipizzazione

#### Robustezza del Codice

- Garantirai che i metodi ricevano i tipi di dati corretti, riducendo gli errori runtime.

## Array Associativi

### Gestione Dati Complessi

- Lavorerai con array multidimensionali per gestire dati annidati, come le informazioni di progresso per ciascun elemento.

## JSON

### Serializzazione di Dati Complessi

- Gestirai l'esportazione e l'importazione di dati con relazioni tra tabelle, affrontando sfide come la preservazione delle chiavi esterne.

## Operatori Logici

### Condizioni Avanzate

- Scriverai condizioni complesse sia in PHP che in SQL per gestire logiche di business più sofisticate.
