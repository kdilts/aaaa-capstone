export class Note {
	constructor(
		public noteId: number,
		public noteApplicationId: number,
		public noteProspectId: number,
		public noteNoteTypeId: number,
		public noteContent: string,
		public noteDateTime: string
	) {}
}