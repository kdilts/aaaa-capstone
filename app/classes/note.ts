export class Note {
	constructor(public noteId: number,
					public noteContent: string,
					public noteNoteTypeId: number,
					public noteApplicationId: number,
					public noteProspectId: number,
					public noteDateTime: string,
					public noteBridgeStaffId: string) {}
}